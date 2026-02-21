<div class="header-style2 fixed-top"
    style="
        background: linear-gradient(135deg, #020617, #0f172a);
        border-bottom: 1px solid rgba(56,189,248,0.2);
        backdrop-filter: blur(10px);
        padding: 12px 16px;
        z-index: 1000;
     ">

    <div class="d-flex justify-content-between align-items-center gap-14">

        {{-- USER INFO --}}
        <div class="d-flex align-items-center gap-12" style="flex: 1;">

            <div style="
                width: 44px;
                height: 44px;
                border-radius: 10px;
                overflow: hidden;
                border: 1.5px solid rgba(56,189,248,0.3);
                box-shadow: 0 0 15px rgba(56,189,248,0.2), inset 0 0 10px rgba(56,189,248,0.1);
                background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(34,197,94,0.05));
            ">
                <img src="{{ asset('images/avt/avt2.jpg') }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <div>
                <strong style="
                    color: #e5e7eb;
                    font-size: 13px;
                    line-height: 1.2;
                    display: block;
                ">
                    {{ auth()->user()->name }}
                </strong>

                <small style="
                    color: #64748b;
                    font-size: 11px;
                    display: block;
                    margin-top: 2px;
                ">
                    {{ auth()->user()->email }}
                </small>
            </div>

        </div>

        {{-- NOTIFICATION & SETTINGS ICONS --}}
        <div class="d-flex align-items-center gap-10">

            <!-- NOTIFICATIONS -->
            <div style="position: relative;">
                <button onclick="toggleNotifications()"
                    style="
                        width: 40px;
                        height: 40px;
                        background: linear-gradient(135deg, rgba(56,189,248,0.1) 0%, rgba(56,189,248,0.05) 100%);
                        border: 1px solid rgba(56,189,248,0.2);
                        border-radius: 8px;
                        color: #38bdf8;
                        font-size: 18px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    "
                    onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.1) 100%)'; this.style.borderColor='rgba(56,189,248,0.4)'; this.style.boxShadow='0 0 15px rgba(56,189,248,0.2)';"
                    onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1) 0%, rgba(56,189,248,0.05) 100%)'; this.style.borderColor='rgba(56,189,248,0.2)'; this.style.boxShadow='none';">
                    <img src="{{ asset('images/icons/bell.svg') }}" alt="Notifications" style="width: 20px; height: 20px;">
                </button>
                <span id="unread-badge" style="
                    position: absolute;
                    top: 6px;
                    right: 6px;
                    width: 8px;
                    height: 8px;
                    background: #ef4444;
                    border-radius: 50%;
                    border: 2px solid #020617;
                    box-shadow: 0 0 8px rgba(239,68,68,0.6);
                    display: none;
                "></span>
            </div>

            <!-- SETTINGS -->
            <a href="{{ route('account.settings') }}"
                style="
                    width: 40px;
                    height: 40px;
                    background: linear-gradient(135deg, rgba(168,85,247,0.1) 0%, rgba(168,85,247,0.05) 100%);
                    border: 1px solid rgba(168,85,247,0.2);
                    border-radius: 8px;
                    color: #a855f7;
                    font-size: 18px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-decoration: none;
                "
                onmouseover="this.style.background='linear-gradient(135deg, rgba(168,85,247,0.15) 0%, rgba(168,85,247,0.1) 100%)'; this.style.borderColor='rgba(168,85,247,0.4)'; this.style.boxShadow='0 0 15px rgba(168,85,247,0.2)';"
                onmouseout="this.style.background='linear-gradient(135deg, rgba(168,85,247,0.1) 0%, rgba(168,85,247,0.05) 100%)'; this.style.borderColor='rgba(168,85,247,0.2)'; this.style.boxShadow='none';">
                <img src="{{ asset('images/icons/account.svg') }}" alt="Account" style="width: 20px; height: 20px;">
            </a>

        </div>

    </div>
</div>

<script>
    // Update unread badge on page load
    updateUnreadBadge();

    // Update badge every 10 seconds
    setInterval(updateUnreadBadge, 10000);

    function updateUnreadBadge() {
        fetch('{{ route("api.notifications.unread-count") }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('unread-badge');
                if (data.unread_count > 0) {
                    badge.style.display = 'block';
                } else {
                    badge.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching unread count:', error));
    }

    function toggleNotifications() {
        fetch('{{ route("api.notifications.index") }}')
            .then(response => response.json())
            .then(data => {
                displayNotifications(data.notifications);
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to load notifications',
                    icon: 'error',
                    confirmButtonColor: '#38bdf8',
                    background: '#020617',
                    color: '#e5e7eb',
                });
            });
    }

    function displayNotifications(notifications) {
        let notificationsHtml = '';

        if (notifications.length === 0) {
            notificationsHtml = '<div style="padding: 20px; text-align: center; color: #94a3b8;">No notifications yet</div>';
        } else {
            notificationsHtml = notifications.map(notification => {
                const iconColor = getIconColor(notification.icon_type);
                const bgColor = getBgColor(notification.icon_type);

                return `
                    <div style="padding: 12px; background: ${bgColor}; border-left: 3px solid ${iconColor}; border-radius: 4px; margin-bottom: 8px;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <p style="margin: 0 0 4px 0; font-weight: 600; font-size: 13px; color: #e5e7eb;">${notification.title}</p>
                                <p style="margin: 0; font-size: 12px; color: #94a3b8;">${notification.message}</p>
                                <p style="margin: 4px 0 0 0; font-size: 11px; color: #64748b;">${notification.created_at}</p>
                            </div>
                            <button onclick="markNotificationAsRead(${notification.id})" style="background: none; border: none; color: #64748b; cursor: pointer; font-size: 16px; padding: 4px 8px;">✓</button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        Swal.fire({
            title: '🔔 Notifications',
            html: `
                <div style="text-align: left; color: #e5e7eb; max-height: 400px; overflow-y: auto;">
                    ${notificationsHtml}
                </div>
            `,
            icon: 'info',
            confirmButtonColor: '#38bdf8',
            confirmButtonText: 'Mark all as read',
            background: '#020617',
            color: '#e5e7eb',
            customClass: {
                popup: 'swal-dark-popup'
            },
            didOpen: () => {
                // Mark all as read when modal opens
                fetch('{{ route("api.notifications.mark-all-as-read") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(() => updateUnreadBadge())
                    .catch(error => console.error('Error marking notifications as read:', error));
            }
        });
    }

    function markNotificationAsRead(notificationId) {
        fetch(`/api/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                updateUnreadBadge();
                toggleNotifications();
            })
            .catch(error => console.error('Error marking notification as read:', error));
    }

    function getIconColor(iconType) {
        const colors = {
            'success': '#22c55e',
            'warning': '#fbbf24',
            'error': '#ef4444',
            'info': '#38bdf8'
        };
        return colors[iconType] || colors['info'];
    }

    function getBgColor(iconType) {
        const colors = {
            'success': 'rgba(34,197,94,0.1)',
            'warning': 'rgba(251,191,36,0.1)',
            'error': 'rgba(239,68,68,0.1)',
            'info': 'rgba(56,189,248,0.1)'
        };
        return colors[iconType] || colors['info'];
    }
</script>

<style>
    .swal-dark-popup {
        background: linear-gradient(135deg, #0f172a 0%, #020617 100%) !important;
        border: 1px solid rgba(56, 189, 248, 0.2) !important;
    }
</style>
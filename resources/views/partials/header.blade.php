<div class="header-style2 fixed-top trade-header-wrap">
    <div class="trade-header">
        <div class="trade-header__profile">
            <div class="trade-header__avatar-shell" style="width: 48px; height: 48px; flex: 0 0 48px;">
                <div class="trade-header__avatar" style="width: 48px; height: 48px; overflow: hidden; border-radius: 16px;">
                    <img src="{{ asset('images/avt/avt2.jpg') }}" alt="{{ auth()->user()->username }}" style="display: block; width: 100%; height: 100%; object-fit: cover;">
                </div>
                <span class="trade-header__signal"></span>
            </div>

            <div class="trade-header__identity">
                <span class="trade-header__eyebrow">Trading Desk</span>
                <strong class="trade-header__name">{{ auth()->user()->username }}</strong>
                <div class="trade-header__meta-row">
                    <span class="trade-header__meta-chip">ID {{ auth()->user()->account_id }}</span>
                </div>
            </div>
        </div>

        <div class="trade-header__actions">
            <button type="button" class="trade-header__action trade-header__action--lang" onclick="toggleLanguageSelector()" aria-label="Open language selector">
                <img src="{{ asset('images/icons/globe.svg') }}" alt="Language">
                <span>Lang</span>
            </button>

            <button type="button" class="trade-header__action trade-header__action--support" onclick="openSupport()" aria-label="Open support center">
                <img src="{{ asset('images/icons/support.svg') }}" alt="Support">
                <span>Support</span>
            </button>
        </div>
    </div>
</div>

<script>
    function toggleLanguageSelector() {
        Swal.fire({
            title: 'ðŸŒ Select Language',
            html: `
                <div style="display: grid; gap: 8px; text-align: left; max-height: 400px; overflow-y: auto;">
                    <button onclick="changeLanguage('en')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/en.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">UK(English)</span>
                    </button>
                    <button onclick="changeLanguage('es')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/es.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Spain(EspaÃ±ol)</span>
                    </button>
                    <button onclick="changeLanguage('fr')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/fr.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">France(FranÃ§ais)</span>
                    </button>
                    <button onclick="changeLanguage('de')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/de.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Germany(Deutsch)</span>
                    </button>
                    <button onclick="changeLanguage('zh')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/zh.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">China(ä¸­æ–‡)</span>
                    </button>
                    <button onclick="changeLanguage('ja')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/jp.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Japan(æ—¥æœ¬èªž)</span>
                    </button>
                    <button onclick="changeLanguage('ko')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/ko.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Korean(í•œêµ­ì–´)</span>
                    </button>
                    <button onclick="changeLanguage('pt')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/pt.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Portugal(PortuguÃªs)</span>
                    </button>
                    <button onclick="changeLanguage('ru')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/ru.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Russia(Ð ÑƒÑÑÐºÐ¸Ð¹)</span>
                    </button>
                    <button onclick="changeLanguage('ar')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/sa.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Arabic(Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©)</span>
                    </button>
                    <button onclick="changeLanguage('hi')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/in.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">India(à¤¹à¤¿à¤¨à¥à¤¦à¥€)</span>
                    </button>
                    <button onclick="changeLanguage('it')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/it.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Italy(Italiano)</span>
                    </button>
                    <button onclick="changeLanguage('nl')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/nl.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Netherlands(Nederlands)</span>
                    </button>
                    <button onclick="changeLanguage('tr')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/tr.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Turkey(TÃ¼rkÃ§e)</span>
                    </button>
                    <button onclick="changeLanguage('pl')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/pl.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Poland(Polski)</span>
                    </button>
                    <button onclick="changeLanguage('vi')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/vn.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Vietnam(Tiáº¿ng Viá»‡t)</span>
                    </button>
                    <button onclick="changeLanguage('th')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/th.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Thailand(à¹„à¸—à¸¢)</span>
                    </button>
                    <button onclick="changeLanguage('id')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: flex-start; gap: 10px; text-align: left;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <img src="{{ asset('icons/flags/id.svg') }}" style="width: 24px; height: 24px; flex-shrink: 0;">
                        <span style="font-weight: 600;">Indonesia(Bahasa Indonesia)</span>
                    </button>
                </div>
            `,
            showConfirmButton: false,
            showCloseButton: true,
            background: '#020617',
            color: '#e5e7eb',
            customClass: {
                popup: 'swal-dark-popup'
            },
            width: '500px'
        });
    }

    function changeLanguage(lang) {
        Swal.close();

        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found');
            Swal.fire({
                title: 'Error',
                text: 'Security token missing. Please refresh the page.',
                icon: 'error',
                background: '#020617',
                color: '#e5e7eb'
            });
            return;
        }

        fetch('/language/change', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.content
            },
            body: JSON.stringify({ language: lang })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Language Changed!',
                    text: 'Language preference saved',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                    background: '#020617',
                    color: '#e5e7eb'
                }).then(() => {
                    window.location.reload();
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Failed to change language',
                icon: 'error',
                background: '#020617',
                color: '#e5e7eb'
            });
        });
    }

    function openSupport() {
        Swal.fire({
            title: 'ðŸ’¬ Support Center',
            html: `
                <div style="display: grid; gap: 12px; text-align: left;">
                    <a href="https://t.me/cryptexa_support" target="_blank" style="padding: 14px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; text-decoration: none; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.1))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)'">
                        <span style="font-size: 24px;">ðŸ“±</span>
                        <div style="text-align: left;">
                            <div style="font-weight: 700; font-size: 14px; color: #38bdf8;">Telegram Support</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">Fast response • 24/7 available</div>
                        </div>
                    </a>
                    <a href="mailto:support@cryptexa.com" style="padding: 14px; background: linear-gradient(135deg, rgba(34,197,94,0.1), rgba(34,197,94,0.05)); border: 1px solid rgba(34,197,94,0.2); border-radius: 10px; color: #e5e7eb; text-decoration: none; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px;" onmouseover="this.style.borderColor='rgba(34,197,94,0.4)'; this.style.background='linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.1))'" onmouseout="this.style.borderColor='rgba(34,197,94,0.2)'; this.style.background='linear-gradient(135deg, rgba(34,197,94,0.1), rgba(34,197,94,0.05)'">
                        <span style="font-size: 24px;">âœ‰ï¸</span>
                        <div style="text-align: left;">
                            <div style="font-weight: 700; font-size: 14px; color: #22c55e;">Email Support</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">support@cryptexa.com</div>
                        </div>
                    </a>
                    <button onclick="Swal.close(); Swal.fire({title: 'Coming Soon', text: 'Live chat will be available soon!', icon: 'info', background: '#020617', color: '#e5e7eb'});" style="padding: 14px; background: linear-gradient(135deg, rgba(168,85,247,0.1), rgba(168,85,247,0.05)); border: 1px solid rgba(168,85,247,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px;" onmouseover="this.style.borderColor='rgba(168,85,247,0.4)'; this.style.background='linear-gradient(135deg, rgba(168,85,247,0.15), rgba(168,85,247,0.1))'" onmouseout="this.style.borderColor='rgba(168,85,247,0.2)'; this.style.background='linear-gradient(135deg, rgba(168,85,247,0.1), rgba(168,85,247,0.05)'">
                        <span style="font-size: 24px;">ðŸ’¬</span>
                        <div style="text-align: left;">
                            <div style="font-weight: 700; font-size: 14px; color: #a855f7;">Live Chat</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">Coming soon</div>
                        </div>
                    </button>
                </div>
            `,
            showConfirmButton: false,
            showCloseButton: true,
            background: '#020617',
            color: '#e5e7eb',
            customClass: {
                popup: 'swal-dark-popup'
            },
            width: '450px'
        });
    }
</script>

<style>
    .trade-header-wrap {
        padding: 10px 14px 12px;
        background:
            linear-gradient(180deg, rgba(2, 6, 23, 0.98), rgba(2, 6, 23, 0.82) 78%, rgba(2, 6, 23, 0));
    }

    .trade-header {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px;
        border: 1px solid rgba(56, 189, 248, 0.16);
        border-radius: 20px;
        background:
            radial-gradient(circle at top right, rgba(56, 189, 248, 0.14), transparent 30%),
            linear-gradient(135deg, rgba(8, 15, 30, 0.96), rgba(15, 23, 42, 0.92));
        box-shadow:
            0 18px 45px rgba(0, 0, 0, 0.28),
            inset 0 1px 0 rgba(255, 255, 255, 0.04);
        overflow: hidden;
    }

    .trade-header::after {
        content: "";
        position: absolute;
        inset: auto -10% -55% 35%;
        height: 90px;
        background: radial-gradient(circle, rgba(34, 197, 94, 0.12), transparent 62%);
        pointer-events: none;
    }

    .trade-header__profile,
    .trade-header__actions {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
    }

    .trade-header__profile {
        min-width: 0;
        flex: 1;
        gap: 12px;
    }

    .trade-header__avatar-shell {
        position: relative;
        flex-shrink: 0;
    }

    .trade-header__avatar {
        width: 46px;
        height: 46px;
        padding: 2px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.7), rgba(34, 197, 94, 0.45));
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.24);
    }

    .trade-header__avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 14px;
        display: block;
        background: #0f172a;
    }

    .trade-header__signal {
        position: absolute;
        right: -1px;
        bottom: -1px;
        width: 12px;
        height: 12px;
        border: 2px solid #08101e;
        border-radius: 999px;
        background: #22c55e;
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.14);
    }

    .trade-header__identity {
        min-width: 0;
        display: grid;
        gap: 4px;
    }

    .trade-header__eyebrow {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: rgba(56, 189, 248, 0.78);
    }

    .trade-header__name {
        display: block;
        overflow: hidden;
        color: #f8fbff;
        font-size: 15px;
        line-height: 1.1;
        font-weight: 800;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .trade-header__meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .trade-header__meta-chip {
        display: inline-flex;
        align-items: center;
        min-height: 22px;
        padding: 0 9px;
        border: 1px solid rgba(148, 163, 184, 0.16);
        border-radius: 999px;
        background: rgba(148, 163, 184, 0.08);
        color: rgba(226, 232, 240, 0.82);
        font-size: 11px;
        letter-spacing: 0.03em;
    }

    .trade-header__actions {
        flex-shrink: 0;
        gap: 8px;
    }

    .trade-header__action {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        width: 54px;
        min-width: 54px;
        height: 54px;
        padding: 0;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.04);
        color: #e2e8f0;
        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
    }

    .trade-header__action:hover {
        transform: translateY(-2px);
        border-color: rgba(56, 189, 248, 0.3);
        background: rgba(255, 255, 255, 0.06);
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.22);
    }

    .trade-header__action img {
        width: 18px;
        height: 18px;
        display: block;
    }

    .trade-header__action span {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        line-height: 1;
    }

    .trade-header__action--lang {
        border-color: rgba(56, 189, 248, 0.22);
        background: linear-gradient(180deg, rgba(56, 189, 248, 0.14), rgba(56, 189, 248, 0.05));
        color: #7dd3fc;
    }

    .trade-header__action--lang img {
        filter: brightness(0) saturate(100%) invert(77%) sepia(52%) saturate(2009%) hue-rotate(166deg) brightness(100%) contrast(99%);
    }

    .trade-header__action--support {
        border-color: rgba(34, 197, 94, 0.22);
        background: linear-gradient(180deg, rgba(34, 197, 94, 0.14), rgba(34, 197, 94, 0.05));
        color: #86efac;
    }

    .trade-header__action--support img {
        filter: brightness(0) saturate(100%) invert(76%) sepia(18%) saturate(1218%) hue-rotate(73deg) brightness(99%) contrast(92%);
    }

    .swal-dark-popup {
        background: linear-gradient(135deg, #0f172a 0%, #020617 100%) !important;
        border: 1px solid rgba(56, 189, 248, 0.2) !important;
        border-radius: 20px !important;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.42) !important;
    }

    @media (max-width: 420px) {
        .trade-header-wrap {
            padding-left: 10px;
            padding-right: 10px;
        }

        .trade-header {
            gap: 10px;
            padding: 10px;
            border-radius: 18px;
        }

        .trade-header__profile {
            gap: 10px;
        }

        .trade-header__avatar {
            width: 42px;
            height: 42px;
        }

        .trade-header__name {
            font-size: 14px;
        }

        .trade-header__action {
            width: 50px;
            min-width: 50px;
            height: 50px;
        }
    }

    @media (min-width: 768px) {
        .trade-header-wrap {
            padding-top: 14px;
        }

        .trade-header {
            padding: 14px 16px;
        }

        .trade-header__name {
            font-size: 16px;
        }

        .trade-header__action {
            width: 58px;
            min-width: 58px;
            height: 58px;
        }
    }
</style>

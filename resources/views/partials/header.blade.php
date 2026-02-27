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
                    {{ auth()->user()->username }}
                </strong>

                <small style="
                    color: #64748b;
                    font-size: 11px;
                    display: block;
                    margin-top: 2px;
                ">
                    ID: {{ auth()->user()->account_id }}
                </small>
            </div>

        </div>

        {{-- LANGUAGE & SETTINGS ICONS --}}
        <div class="d-flex align-items-center gap-10">

            <!-- LANGUAGE SELECTOR -->
            <div style="position: relative;">
                <button onclick="toggleLanguageSelector()"
                    style="
                        width: 36px;
                        min-width: 36px;
                        height: 36px;
                        padding: 0;
                        background: linear-gradient(135deg, rgba(56,189,248,0.1) 0%, rgba(56,189,248,0.05) 100%);
                        border: 1px solid rgba(56,189,248,0.2);
                        border-radius: 8px;
                        color: #38bdf8;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    "
                    onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.1) 100%)'; this.style.borderColor='rgba(56,189,248,0.4)'; this.style.boxShadow='0 0 15px rgba(56,189,248,0.2)';"
                    onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1) 0%, rgba(56,189,248,0.05) 100%)'; this.style.borderColor='rgba(56,189,248,0.2)'; this.style.boxShadow='none';">
                    <img src="{{ asset('images/icons/globe.svg') }}" alt="Language" style="width: 18px; height: 18px; filter: brightness(0) saturate(100%) invert(70%) sepia(51%) saturate(2878%) hue-rotate(169deg) brightness(101%) contrast(101%);">
                </button>
            </div>

            <!-- SUPPORT -->
            <button onclick="openSupport()"
                style="
                    width: 36px;
                    min-width: 36px;
                    height: 36px;
                    padding: 0;
                    background: linear-gradient(135deg, rgba(34,197,94,0.1) 0%, rgba(34,197,94,0.05) 100%);
                    border: 1px solid rgba(34,197,94,0.2);
                    border-radius: 8px;
                    color: #22c55e;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                "
                onmouseover="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(34,197,94,0.1) 100%)'; this.style.borderColor='rgba(34,197,94,0.4)'; this.style.boxShadow='0 0 15px rgba(34,197,94,0.2)';"
                onmouseout="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.1) 0%, rgba(34,197,94,0.05) 100%)'; this.style.borderColor='rgba(34,197,94,0.2)'; this.style.boxShadow='none';">
                <img src="{{ asset('images/icons/support.svg') }}" alt="Support" style="width: 18px; height: 18px; filter: brightness(0) saturate(100%) invert(70%) sepia(98%) saturate(459%) hue-rotate(76deg) brightness(98%) contrast(91%);">
            </button>

        </div>

    </div>
</div>

<script>
    function toggleLanguageSelector() {
        Swal.fire({
            title: '🌍 Select Language',
            html: `
                <div style="display: grid; gap: 8px; text-align: left; max-height: 400px; overflow-y: auto;">
                    <button onclick="changeLanguage('en')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇬🇧</span>
                        <span style="font-weight: 600;">English</span>
                    </button>
                    <button onclick="changeLanguage('es')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇪🇸</span>
                        <span style="font-weight: 600;">Español</span>
                    </button>
                    <button onclick="changeLanguage('fr')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇫🇷</span>
                        <span style="font-weight: 600;">Français</span>
                    </button>
                    <button onclick="changeLanguage('de')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇩🇪</span>
                        <span style="font-weight: 600;">Deutsch</span>
                    </button>
                    <button onclick="changeLanguage('zh')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇨🇳</span>
                        <span style="font-weight: 600;">中文</span>
                    </button>
                    <button onclick="changeLanguage('ja')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇯🇵</span>
                        <span style="font-weight: 600;">日本語</span>
                    </button>
                    <button onclick="changeLanguage('ko')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇰🇷</span>
                        <span style="font-weight: 600;">한국어</span>
                    </button>
                    <button onclick="changeLanguage('pt')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇵🇹</span>
                        <span style="font-weight: 600;">Português</span>
                    </button>
                    <button onclick="changeLanguage('ru')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇷🇺</span>
                        <span style="font-weight: 600;">Русский</span>
                    </button>
                    <button onclick="changeLanguage('ar')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇸🇦</span>
                        <span style="font-weight: 600;">العربية</span>
                    </button>
                    <button onclick="changeLanguage('hi')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇮🇳</span>
                        <span style="font-weight: 600;">हिन्दी</span>
                    </button>
                    <button onclick="changeLanguage('it')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇮🇹</span>
                        <span style="font-weight: 600;">Italiano</span>
                    </button>
                    <button onclick="changeLanguage('nl')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇳🇱</span>
                        <span style="font-weight: 600;">Nederlands</span>
                    </button>
                    <button onclick="changeLanguage('tr')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇹🇷</span>
                        <span style="font-weight: 600;">Türkçe</span>
                    </button>
                    <button onclick="changeLanguage('pl')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇵🇱</span>
                        <span style="font-weight: 600;">Polski</span>
                    </button>
                    <button onclick="changeLanguage('vi')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇻🇳</span>
                        <span style="font-weight: 600;">Tiếng Việt</span>
                    </button>
                    <button onclick="changeLanguage('th')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇹🇭</span>
                        <span style="font-weight: 600;">ไทย</span>
                    </button>
                    <button onclick="changeLanguage('id')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇮🇩</span>
                        <span style="font-weight: 600;">Bahasa Indonesia</span>
                    </button>
                    <button onclick="changeLanguage('ms')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇲🇾</span>
                        <span style="font-weight: 600;">Bahasa Melayu</span>
                    </button>
                    <button onclick="changeLanguage('sv')" style="padding: 10px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 20px;">🇸🇪</span>
                        <span style="font-weight: 600;">Svenska</span>
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
            title: '💬 Support Center',
            html: `
                <div style="display: grid; gap: 12px; text-align: left;">
                    <a href="https://t.me/cryptexa_support" target="_blank" style="padding: 14px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; text-decoration: none; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.1))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)'">
                        <span style="font-size: 24px;">📱</span>
                        <div style="text-align: left;">
                            <div style="font-weight: 700; font-size: 14px; color: #38bdf8;">Telegram Support</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">Fast response • 24/7 available</div>
                        </div>
                    </a>
                    <a href="mailto:support@cryptexa.com" style="padding: 14px; background: linear-gradient(135deg, rgba(34,197,94,0.1), rgba(34,197,94,0.05)); border: 1px solid rgba(34,197,94,0.2); border-radius: 10px; color: #e5e7eb; text-decoration: none; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px;" onmouseover="this.style.borderColor='rgba(34,197,94,0.4)'; this.style.background='linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.1))'" onmouseout="this.style.borderColor='rgba(34,197,94,0.2)'; this.style.background='linear-gradient(135deg, rgba(34,197,94,0.1), rgba(34,197,94,0.05)'">
                        <span style="font-size: 24px;">✉️</span>
                        <div style="text-align: left;">
                            <div style="font-weight: 700; font-size: 14px; color: #22c55e;">Email Support</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">support@cryptexa.com</div>
                        </div>
                    </a>
                    <button onclick="Swal.close(); Swal.fire({title: 'Coming Soon', text: 'Live chat will be available soon!', icon: 'info', background: '#020617', color: '#e5e7eb'});" style="padding: 14px; background: linear-gradient(135deg, rgba(168,85,247,0.1), rgba(168,85,247,0.05)); border: 1px solid rgba(168,85,247,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px;" onmouseover="this.style.borderColor='rgba(168,85,247,0.4)'; this.style.background='linear-gradient(135deg, rgba(168,85,247,0.15), rgba(168,85,247,0.1))'" onmouseout="this.style.borderColor='rgba(168,85,247,0.2)'; this.style.background='linear-gradient(135deg, rgba(168,85,247,0.1), rgba(168,85,247,0.05)'">
                        <span style="font-size: 24px;">💬</span>
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
    .swal-dark-popup {
        background: linear-gradient(135deg, #0f172a 0%, #020617 100%) !important;
        border: 1px solid rgba(56, 189, 248, 0.2) !important;
    }
</style>
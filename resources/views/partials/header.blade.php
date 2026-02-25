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

        {{-- LANGUAGE & SETTINGS ICONS --}}
        <div class="d-flex align-items-center gap-10">

            <!-- LANGUAGE SELECTOR -->
            <div style="position: relative;">
                <button onclick="toggleLanguageSelector()"
                    style="
                        width: 40px;
                        height: 40px;
                        background: linear-gradient(135deg, rgba(56,189,248,0.1) 0%, rgba(56,189,248,0.05) 100%);
                        border: 1px solid rgba(56,189,248,0.2);
                        border-radius: 8px;
                        color: #38bdf8;
                        font-size: 20px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    "
                    onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.1) 100%)'; this.style.borderColor='rgba(56,189,248,0.4)'; this.style.boxShadow='0 0 15px rgba(56,189,248,0.2)';"
                    onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1) 0%, rgba(56,189,248,0.05) 100%)'; this.style.borderColor='rgba(56,189,248,0.2)'; this.style.boxShadow='none';">
                    🌍
                </button>
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
    function toggleLanguageSelector() {
        Swal.fire({
            title: '🌍 Select Language',
            html: `
                <div style="display: grid; gap: 10px; text-align: left;">
                    <button onclick="changeLanguage('en')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 24px;">🇬🇧</span>
                        <span style="font-weight: 600;">English</span>
                    </button>
                    <button onclick="changeLanguage('es')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 24px;">🇪🇸</span>
                        <span style="font-weight: 600;">Español</span>
                    </button>
                    <button onclick="changeLanguage('fr')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 24px;">🇫🇷</span>
                        <span style="font-weight: 600;">Français</span>
                    </button>
                    <button onclick="changeLanguage('de')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 24px;">🇩🇪</span>
                        <span style="font-weight: 600;">Deutsch</span>
                    </button>
                    <button onclick="changeLanguage('zh')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'">
                        <span style="font-size: 24px;">🇨🇳</span>
                        <span style="font-weight: 600;">中文</span>
                    </button>
                </div>
            `,
            showConfirmButton: false,
            showCloseButton: true,
            background: '#020617',
            color: '#e5e7eb',
            customClass: {
                popup: 'swal-dark-popup'
            }
        });
    }

    function changeLanguage(lang) {
        Swal.close();
        Swal.fire({
            title: 'Language Changed',
            text: `Language set to ${lang.toUpperCase()}`,
            icon: 'success',
            timer: 1500,
            showConfirmButton: false,
            background: '#020617',
            color: '#e5e7eb'
        });
        // Here you can add actual language change logic
        console.log('Language changed to:', lang);
    }
</script>

<style>
    .swal-dark-popup {
        background: linear-gradient(135deg, #0f172a 0%, #020617 100%) !important;
        border: 1px solid rgba(56, 189, 248, 0.2) !important;
    }
</style>
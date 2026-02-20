<div id="preloader" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 50%, #0d1726 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s ease;
    backdrop-filter: blur(5px);
">
    <!-- Spinner Container -->
    <div style="text-align: center;">
        <!-- Animated Spinner -->
        <div style="
            width: 60px;
            height: 60px;
            margin: 0 auto 24px;
            position: relative;
        ">
            <div style="
                width: 100%;
                height: 100%;
                border: 3px solid rgba(56, 189, 248, 0.2);
                border-top: 3px solid #38bdf8;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            "></div>
            <div style="
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 40px;
                height: 40px;
                border: 2px solid rgba(34, 211, 238, 0.2);
                border-right: 2px solid #22d3ee;
                border-radius: 50%;
                animation: spin-reverse 2s linear infinite;
            "></div>
        </div>

        <!-- App Name -->
        <h1 style="
            color: #38bdf8;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 8px 0;
            letter-spacing: 2px;
            text-transform: uppercase;
            animation: fadeInUp 0.8s ease 0.2s backwards, glow 2s ease-in-out 1.2s infinite;
            text-shadow: 0 0 10px rgba(56, 189, 248, 0.5);
        ">Cryptexa</h1>

        <!-- Loading Text -->
        <p style="
            color: rgba(226, 232, 240, 0.6);
            font-size: 12px;
            margin: 0;
            letter-spacing: 1px;
            animation: fadeInUp 0.8s ease 0.4s backwards;
        ">LOADING</p>

        <!-- Dot Animation -->
        <div style="
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 12px;
            animation: fadeInUp 0.8s ease 0.6s backwards;
        ">
            <span style="
                width: 8px;
                height: 8px;
                background: #38bdf8;
                border-radius: 50%;
                animation: pulse 1.5s ease infinite;
            "></span>
            <span style="
                width: 8px;
                height: 8px;
                background: #22d3ee;
                border-radius: 50%;
                animation: pulse 1.5s ease 0.2s infinite;
            "></span>
            <span style="
                width: 8px;
                height: 8px;
                background: #06b6d4;
                border-radius: 50%;
                animation: pulse 1.5s ease 0.4s infinite;
            "></span>
        </div>
    </div>
</div>

<style>
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes spin-reverse {
        0% {
            transform: rotate(360deg);
        }

        100% {
            transform: rotate(0deg);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.3;
            transform: scale(1);
        }

        50% {
            opacity: 1;
            transform: scale(1.2);
        }
    }

    @keyframes glow {

        0%,
        100% {
            opacity: 1;
            text-shadow: 0 0 10px rgba(56, 189, 248, 0.5);
        }

        50% {
            opacity: 0.6;
            text-shadow: 0 0 20px rgba(56, 189, 248, 0.8), 0 0 30px rgba(34, 211, 238, 0.5);
        }
    }

    #preloader.hidden {
        opacity: 0;
        pointer-events: none;
        visibility: hidden;
    }
</style>

<script>
    // Directly hide preloader after 3 seconds
    setTimeout(() => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            preloader.style.pointerEvents = 'none';
            preloader.style.visibility = 'hidden';
        }
    }, 3000);

    // Show preloader on link clicks
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (link && link.href && !link.target && !link.hasAttribute('data-no-loader')) {
            // Check if it's an internal link
            if (link.href.includes(window.location.origin)) {
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    preloader.style.opacity = '1';
                    preloader.style.pointerEvents = 'auto';
                    preloader.style.visibility = 'visible';
                    // Hide again after 3 seconds
                    setTimeout(() => {
                        preloader.style.opacity = '0';
                        preloader.style.pointerEvents = 'none';
                        preloader.style.visibility = 'hidden';
                    }, 3000);
                }
            }
        }
    });

    // Show preloader on form submissions
    document.addEventListener('submit', (e) => {
        const form = e.target;
        if (!form.hasAttribute('data-no-loader')) {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.opacity = '1';
                preloader.style.pointerEvents = 'auto';
                preloader.style.visibility = 'visible';
                // Hide again after 3 seconds
                setTimeout(() => {
                    preloader.style.opacity = '0';
                    preloader.style.pointerEvents = 'none';
                    preloader.style.visibility = 'hidden';
                }, 3000);
            }
        }
    });

    // Hide preloader on back/forward navigation after 3 seconds
    window.addEventListener('pageshow', () => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.opacity = '1';
            preloader.style.pointerEvents = 'auto';
            preloader.style.visibility = 'visible';
            setTimeout(() => {
                preloader.style.opacity = '0';
                preloader.style.pointerEvents = 'none';
                preloader.style.visibility = 'hidden';
            }, 1900);
        }
    });
</script>
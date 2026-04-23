{{-- Logo SVG de Mr. Sabor: llama de fuego --}}
<svg viewBox="0 0 80 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="logo-flame" aria-label="Mr. Sabor logo">
    <!-- llama exterior -->
    <path d="M40 4 C40 4 22 22 20 38 C18 48 22 54 26 58
             C24 50 28 44 34 42 C32 50 36 56 40 60
             C44 56 48 50 46 42 C52 44 56 50 54 58
             C58 54 62 48 60 38 C58 22 40 4 40 4Z"
          fill="url(#fireOuter)"/>
    <!-- llama interior -->
    <path d="M40 24 C40 24 30 36 30 46 C30 52 34 56 40 58
             C46 56 50 52 50 46 C50 36 40 24 40 24Z"
          fill="url(#fireInner)" opacity="0.9"/>
    <!-- punto central brillante -->
    <circle cx="40" cy="50" r="5" fill="#FFE580" opacity="0.85"/>
    <defs>
        <linearGradient id="fireOuter" x1="40" y1="4" x2="40" y2="60" gradientUnits="userSpaceOnUse">
            <stop offset="0%"   stop-color="#FF4500"/>
            <stop offset="50%"  stop-color="#E07820"/>
            <stop offset="100%" stop-color="#FFB830"/>
        </linearGradient>
        <linearGradient id="fireInner" x1="40" y1="24" x2="40" y2="58" gradientUnits="userSpaceOnUse">
            <stop offset="0%"   stop-color="#FFF176"/>
            <stop offset="100%" stop-color="#FFB830"/>
        </linearGradient>
    </defs>
</svg>

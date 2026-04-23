<x-app-layout>
<div class="dashboard-content">

    {{-- ══ BIENVENIDA ══ --}}
    <div class="welcome-card">
        <div class="welcome-avatar">🔥</div>
        <div class="welcome-text">
            <h2>¡Hola, {{ Auth::user()->name }}! 👋</h2>
            <p>Bienvenido a Mr. Sabor Burgers &mdash; ¿Qué se te antoja hoy?</p>
        </div>
    </div>

    {{-- ══ STATS ══ --}}
    <div class="stat-grid">
        <div class="stat-card orange">
            <div class="stat-icon">🛒</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Pedidos realizados</div>
        </div>
        <div class="stat-card amber">
            <div class="stat-icon">⭐</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Puntos acumulados</div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon">🎁</div>
            <div class="stat-value">1</div>
            <div class="stat-label">Cupón de bienvenida</div>
        </div>
        <div class="stat-card red">
            <div class="stat-icon">❤️</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Favoritos</div>
        </div>
    </div>

    {{-- ══════════════════════════
         SECCIÓN: BURGERS
    ══════════════════════════ --}}
    <div class="section-header" id="burgers">
        <span class="section-title">🍔 Burgers</span>
        <span class="section-badge">Artesanales</span>
        <div class="section-header-line"></div>
    </div>

    <div class="menu-grid">

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🍔</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Burger</span>
                <h3 class="product-name">CLÁSICA</h3>
                <p class="product-desc">Pan Artesanal, Carne De Res 100% Artesanal 150G, Queso, Tomate, Lechuga, Salsa BBQ Y Salsa Mr.</p>
                <div class="product-footer">
                    <span class="product-price">$14.9K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🌽</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Burger</span>
                <h3 class="product-name">MONTAÑERA</h3>
                <p class="product-desc">Plátano De La Casa, Carne De Res 100% Artesanal 150G, Queso, Maíz Tierno, Cebolla, Tomate, Lechuga, Salsa BBQ Y Salsa Mr. Especial.</p>
                <div class="product-footer">
                    <span class="product-price">$16.5K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🥓</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Burger</span>
                <h3 class="product-name">BURGO</h3>
                <p class="product-desc">Pan Artesanal, Carne De Res 100% Artesanal 150G, Queso Americano, Trozos De Tocineta Ahumada Y Cebolla, Lechuga Y Salsa BBQ Mr.</p>
                <div class="product-footer">
                    <span class="product-price">$16.5K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🍳</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Burger</span>
                <h3 class="product-name">CAMPESINA</h3>
                <p class="product-desc">Plátano De La Casa, Carne De Res 100% Artesanal 150G, Queso, Huevo Frito, Trozos De Tocineta Ahumada Y Cebolla, Lechuga, Tomate, Salsa BBQ Mr. Y Salsa Mr.</p>
                <div class="product-footer">
                    <span class="product-price">$16.9K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🍌</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Burger</span>
                <h3 class="product-name">ABORRAJADA</h3>
                <p class="product-desc">Pan Artesanal, Carne De Res 100% Artesanal 150G, Queso Gratinado, Tajadas Plátano Maduro, Tocineta Ahumada, Salsa Mr. Y Salsa Mr. Dulce.</p>
                <div class="product-footer">
                    <span class="product-price">$18.9K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🔥</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Burger</span>
                <h3 class="product-name">BARBACOA</h3>
                <p class="product-desc">Pan Artesanal, Carne De Res 100% Artesanal 150G, Queso, Tocineta Ahumada, Aros Cebolla Crocante, Salsa BBQ Mr. Especial.</p>
                <div class="product-footer">
                    <span class="product-price">$17.9K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🧀</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Burger</span>
                <h3 class="product-name">DOBLE CHEESE</h3>
                <p class="product-desc">Pan Artesanal, Doble Carne De Res 100% Artesanal, Doble Queso Americano, Tocineta Ahumada, Salsa BBQ Y Salsa Mr.</p>
                <div class="product-footer">
                    <span class="product-price">$24.9K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">💥</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Burger</span>
                <h3 class="product-name">SUPER BURGO</h3>
                <p class="product-desc">Pan Artesanal, Doble Carne De Res 100% Artesanal, Doble Queso Americano, Trozos De Tocineta Ahumada Y Cebolla, Lechuga Y Salsa BBQ Mr.</p>
                <div class="product-footer">
                    <span class="product-price">$24.9K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

    </div>{{-- /burgers --}}

    {{-- ══════════════════════════
         SECCIÓN: SALCHIPAPAS
    ══════════════════════════ --}}
    <div class="section-header" id="salchipapas">
        <span class="section-title">🍟 Salchipapas</span>
        <span class="section-badge">Platos</span>
        <div class="section-header-line"></div>
    </div>

    <div class="menu-grid compact">

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🍟</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Salchipapa</span>
                <h3 class="product-name">CLÁSICA</h3>
                <p class="product-desc">Trozos De Salchicha Americana, Queso Gratinado, Papa A La Francesa.</p>
                <div class="product-footer">
                    <span class="product-price">$14.9K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🧀</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Salchipapa</span>
                <h3 class="product-name">QUESUDA</h3>
                <p class="product-desc">Trozos De Salchicha Americana, Queso Gratinado, Papa Fosforito, Papa A La Francesa, Salsa Queso Cheddar Y Salsa Kétchup.</p>
                <div class="product-footer">
                    <span class="product-price">$17.5K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🌾</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Salchipapa</span>
                <h3 class="product-name">GRANJERA</h3>
                <p class="product-desc">Trozos De Salchicha Americana, Queso Gratinado, Tajadas Plátano Maduro Con Trocitos De Tocineta Ahumada, Papa A La Francesa, Salsa Mr. Y Salsa Mr. Dulce.</p>
                <div class="product-footer">
                    <span class="product-price">$19.5K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

    </div>{{-- /salchipapas --}}

    {{-- ══════════════════════════
         SECCIÓN: PLATOS
    ══════════════════════════ --}}
    <div class="section-header" id="platos">
        <span class="section-title">🍽️ Platos</span>
        <span class="section-badge">Especiales</span>
        <div class="section-header-line"></div>
    </div>

    <div class="menu-grid">

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🥘</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Plato</span>
                <h3 class="product-name">TÍPICA PICADA</h3>
                <p class="product-desc">Plátano De La Casa, Carne De Res 100% Artesanal 150G, Queso Fundido, Maíz Tierno, Lechuga, Tomate, Cebolla, Salsa BBQ Y Salsa Mr. Especial.</p>
                <div class="product-footer">
                    <span class="product-price">$19.5K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🫙</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Plato</span>
                <h3 class="product-name">PICADA MR.</h3>
                <p class="product-desc">Carne De Res 100% Artesanal 150G, Tajadas Plátano Maduro, Trozos De Salchicha Americana, Queso Gratinado, Maíz Tierno, Lechuga, Papas Francesa, Salsa Tártara Mr.</p>
                <div class="product-footer">
                    <span class="product-price">$26.5K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🌽</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Plato</span>
                <h3 class="product-name">MAZORCADA MR.</h3>
                <p class="product-desc">Trozos De Pechuga Asada a la Plancha (Aprox 150grs), Trozos De Salchicha Americana, Queso Gratinado, Maíz Tierno, Lechuga, Papa Fosforito, Papa A La Francesa, Salsa BBQ Dulce, Salsa De Maíz Mr. Y Sour Cream.</p>
                <div class="product-footer">
                    <span class="product-price">$25.9K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-emoji-wrap">
                <span class="product-emoji">🍗</span>
            </div>
            <div class="product-body">
                <span class="product-category-tag">Plato</span>
                <h3 class="product-name">PECHUGA A LA PLANCHA</h3>
                <p class="product-desc">Pechuga Asada a la Plancha (Aprox 300grs), Acompañada De Cascos de Papa y Ensalada Artesanal con Vinagreta Mr.</p>
                <div class="product-footer">
                    <span class="product-price">$26.5K</span>
                    <button class="btn-add" title="Agregar al pedido">+</button>
                </div>
            </div>
        </div>

    </div>{{-- /platos --}}

</div>
</x-app-layout>

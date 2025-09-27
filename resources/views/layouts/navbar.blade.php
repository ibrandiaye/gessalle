 <!-- Header -->
                <header class="top">
                    <div style="display:flex;align-items:center;gap:12px">
                        <!-- simplified hamburger button -->
                        <button id="menuToggle" class="menu-btn" aria-label="Basculer le menu" aria-expanded="false">
                            <span class="hamburger" aria-hidden="true"></span>
                        </button>
                         @if(isset($title) )
                            
                        <div class="title">{{$title}}</div>
                        @else
                        
                        <div class="title">#</div>
                        @endif
                    </div>

                    <div class="search">
                        <input type="search" placeholder="Recherche" aria-label="Recherche">
                    </div>

                    <div style="display:flex;align-items:center;gap:14px">
                        <div class="profile">
                            <div style="text-align:right">
                                <div class="meta">KOULIS FITNESS</div>
                                <div class="sub">Administrator</div>
                            </div>
                            <img src="profi5.png" alt="Admin avatar">
                        </div>
                    </div>
                </header>
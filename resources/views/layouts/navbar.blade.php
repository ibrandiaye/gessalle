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
                                <div class="meta"></div>
                                <div class="sub"></div>
                            </div>
                          
                           @if(auth()->user()->salle_id != null)
                                   @php
                                          $salle = Illuminate\Support\Facades\DB::table('salles')->where('id',auth()->user()->salle_id)->first();
                                         
                                    @endphp
                                     @if($salle->logo) <img class="img img-rounded" height="40px" src="{{ asset('logo/'.$salle->logo) }}"> @endif
                        
                           @endif
                        </div>
                    </div>
                </header>
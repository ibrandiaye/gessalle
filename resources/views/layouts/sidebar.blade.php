<!-- Sidebar -->
        <aside class="sidebar" id="sidebar" aria-label="Navigation principale">
            <div class="brand">
                <img src="{{ asset('images/logocustom.png')}}" href="{{ route('home') }}" class="active" data-key="dashboard" alt="Logo 2SA">
            </div>

            <nav class="nav" aria-label="Menu">
                  @php
                    $user = Auth::user();
                  @endphp
                <a href="{{ route('home') }}" class="active" data-key="dashboard">
                    <span class="material-symbols-outlined ico" aria-hidden="true">dashboard</span>
                    <span class="label">Tableau de bords</span>
                </a>
                 @if($user->role=="superadmin")
                               
                                    <a href="{{ route('user.index') }}" data-key="employes"> 
                                      <span class="material-symbols-outlined ico" aria-hidden="true">people</span>
                                      <span class="label">Utilisateur</span>
                                    </a>
                                 
                               
                                    <a href="{{ route('salle.index') }}" data-key="boutique">
                                      <span class="material-symbols-outlined ico" aria-hidden="true">store</span>
                                      <span class="label">Salle </span>
                                    </a>
                                 
                               
                                    <a href="" >
                                      <span class="material-symbols-outlined">license</span>
                                      <span class="label">Licence </span>
                                    </a>
                                 
                               
                                    <a href="{{ route('plan.index') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">edit_calendar</span>
                                      <span class="label">Plan </span>
                                    </a>
                                 
                               
                                    <a href="{{ route('configuration.index') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">settings_account_box</span>
                                      <span class="label">Configuration </span>
                                    </a>
                                 
                            @elseif($user->role=="admin")
                               
                                    <a href="{{ route('client.index') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">Group</span>
                                      <span class="label">Clients </span>
                                    </a>
                                 
                                 
                                    <a href="{{ route('souscription.index') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">confirmation_number</span>
                                      <span class="label">Tickets </span>
                                    </a>
                                 
                               
                                    <a href="{{ route('depense.index') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">payments</span>
                                      <span class="label">Depenses </span></a>
                                 
                               
                                    <a href="{{ route('employe.index') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">people</span>
                                      <span class="label">Employes </span>
                                    </a>
                                 

                               
                                    <a href="{{ route('offre.index') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">local_offer</span>
                                      <span class="label">Offres </span></a>
                                 

                               
                                    <a  href="{{ route('sms.index') }}"  ><span class="material-symbols-outlined ico" aria-hidden="true">sms</span><span class="label"> Sms </span></a>
                                 
                                
                                    <a href="{{ route('indexClient') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">store</span>
                                      <span class="label">Boutique</span>
                                    </a>
                                 
                                
                                    <a href="{{ route('rapport') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">analytics</span>
                                      <span class="label">Rapports </span></a>
                                 

                                @elseif($user->role=="employe")
                                
                                  <a href="{{ route('client.index') }}" >
                                    <span class="material-symbols-outlined ico" aria-hidden="true">people</span>
                                    <span class="label">Clients </span>
                                  </a>
                                 
                                 
                                    <a href="{{ route('souscription.index') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">confirmation_number</span>
                                      <span class="label">Tickets </span>
                                    </a>
                                 
                               
                                    <a href="{{ route('depense.index') }}" >
                                      <span class="material-symbols-outlined ico" aria-hidden="true">payments</span>
                                      <span class="label">Dépenses </span>
                                    </a>
                                 

                            @endif
             
            </nav>

            <div class="bottom">
                <a href="#" class="small-btn settings" data-key="settings">
                    <span class="material-symbols-outlined" aria-hidden="true">settings</span>
                    <span class="label">Paramètre</span>
                </a>

                <a class="small-btn logout" data-key="logout" title="Se déconnecter" aria-label="Se déconnecter" tabindex="0" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <span class="material-symbols-outlined" aria-hidden="true">logout</span>
                  <span class="label">{{ __('Se déconnecter') }}</span>
                </a>

                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
            </div>
          </aside>

          
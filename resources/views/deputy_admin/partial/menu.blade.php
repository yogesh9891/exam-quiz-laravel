 <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading">Menu</li>
                        <li>
                            {{-- <a href="{{route('school.dashboard')}}" class="mm-active" :active="request()->routeIs('dashboard')">
                                <i class="metismenu-icon pe-7s-rocket"></i> Dashboards
                            </a> --}}
                             <x-jet-responsive-nav-link href="{{ route('deputy_admin.dashboard') }}" :active="request()->routeIs('deputy_admin.dashboard')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Dashboard') }}
                            </x-jet-responsive-nav-link>
                        </li>
                     
                         <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i> Paper Management
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                             <x-jet-responsive-nav-link href="{{ route('template.index') }}" :active="request()->routeIs('admin.template.index')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Template') }}
                            </x-jet-responsive-nav-link>
                        </li> 
                         <li>
                             <x-jet-responsive-nav-link href="{{ route('paper.index') }}" :active="request()->routeIs('admin.paper.index')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Paper Top Part') }}
                            </x-jet-responsive-nav-link>
                        </li>
                          <li>
                             <x-jet-responsive-nav-link href="{{ route('question.index') }}" :active="request()->routeIs('admin.question.index')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Question') }}
                            </x-jet-responsive-nav-link>
                        </li>
                        <li>
                             <x-jet-responsive-nav-link href="{{ route('question-paper.index') }}" :active="request()->routeIs('admin.question-paper.index')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Question Paper') }}
                            </x-jet-responsive-nav-link>
                        </li>
                            </ul>
                        </li>

                            <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i> Assigned Paper
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('assigned_paper.index') }}" :active="request()->routeIs('assigned_paper.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Draft') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                               <li>
                                     <x-jet-responsive-nav-link href="{{ route('sent_paper') }}" :active="request()->routeIs('sent_paper')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Sent') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                              
                            </ul>
                        </li>
</ul>
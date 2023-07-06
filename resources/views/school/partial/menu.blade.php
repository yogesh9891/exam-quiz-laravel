 <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading">Menu</li>
                        <li>
                            {{-- <a href="{{route('school.dashboard')}}" class="mm-active" :active="request()->routeIs('dashboard')">
                                <i class="metismenu-icon pe-7s-rocket"></i> Dashboards
                            </a> --}}
                             <x-jet-responsive-nav-link href="{{ route('school.dashboard') }}" :active="request()->routeIs('school.dashboard')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Dashboard') }}
                            </x-jet-responsive-nav-link>
                        </li>

                           <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i>Reports
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('school.class.reports') }}" :active="request()->routeIs('school.class.reports')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Class/Section-Wise') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('school.student.reports') }}" :active="request()->routeIs('school.student.reports')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Student-Wise') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                                 <li>
                                     <x-jet-responsive-nav-link href="{{ route('school.paper.reports') }}" :active="request()->routeIs('school.paper.reports')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Paper-Wise') }}
                                    </x-jet-responsive-nav-link>
                              </li>
                               
                            </ul>
                        </li>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('teachers.index',auth()->user()->id) }}" :active="request()->routeIs('teachers.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Teachers') }}
                                    </x-jet-responsive-nav-link>
                               </li>
                               <li>
                                     <x-jet-responsive-nav-link href="{{ route('student.index',auth()->user()->id) }}" :active="request()->routeIs('student.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Students') }}
                                    </x-jet-responsive-nav-link>
                               </li>
                               <li>
                                     <x-jet-responsive-nav-link href="{{ route('class.index',auth()->user()->id) }}" :active="request()->routeIs('class.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Classes') }}
                                    </x-jet-responsive-nav-link>
                               </li>

</ul>
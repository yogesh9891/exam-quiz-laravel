 <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading">Menu</li>
                        <li>
                            {{-- <a href="{{ url('/')}}" class="mm-active" :active="request()->routeIs('dashboard')">
                                <i class="metismenu-icon pe-7s-rocket"></i> Dashboards
                            </a> --}}
                             <x-jet-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('dashboard')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Dashboard') }}
                            </x-jet-responsive-nav-link>
                        </li>
                         <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i> General Setting
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('admin.category.index') }}" :active="request()->routeIs('admin.category.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Category') }}
                                    </x-jet-responsive-nav-link>
                                </li>
                             <li>
                                     <x-jet-responsive-nav-link href="{{ route('admin.classes.index') }}" :active="request()->routeIs('admin.classes.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Gloabl Class') }}
                                    </x-jet-responsive-nav-link>
                                </li>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('admin.sections.index') }}" :active="request()->routeIs('admin.sections.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Gloabl Section') }}
                                    </x-jet-responsive-nav-link>
                                </li>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('admin.subjects.index') }}" :active="request()->routeIs('admin.subjects.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Tree') }}
                                    </x-jet-responsive-nav-link>
                                </li> 
                              
                            </ul>
                        </li>
                      {{--   <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i> User Management
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li class="">

                                    <x-jet-responsive-nav-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Users') }}
                                    </x-jet-responsive-nav-link>


                                </li>
                                <li>
                                    <x-jet-responsive-nav-link href="{{ route('admin.user_role') }}" :active="request()->routeIs('admin.user_role')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Roles') }}
                                    </x-jet-responsive-nav-link>
                                </li>
                            </ul>
                        </li> --}}
                             <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i> School Management
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                 <li>
                                     <x-jet-responsive-nav-link href="{{ route('admin.school_group.index') }}" :active="request()->routeIs('admin.category.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('School Groups') }}
                                    </x-jet-responsive-nav-link>
                                </li>
                            
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('admin.schools.index') }}" :active="request()->routeIs('admin.schools.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Schools') }}
                                    </x-jet-responsive-nav-link>
                                </li>  
                              
                            </ul>
                        </li>
                  {{--        <li>
                             <x-jet-responsive-nav-link href="{{ route('admin.classes') }}" :active="request()->routeIs('admin.classes')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Class') }}
                            </x-jet-responsive-nav-link>
                        </li>
                        <li>
                             <x-jet-responsive-nav-link href="{{ route('admin.sections') }}" :active="request()->routeIs('admin.sections')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Section') }}
                            </x-jet-responsive-nav-link>
                        </li>
                        <li>
                             <x-jet-responsive-nav-link href="{{ route('admin.subjects') }}" :active="request()->routeIs('admin.subjects')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Subject') }}
                            </x-jet-responsive-nav-link>
                        </li> --}}

                         <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i> Paper Management
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                             <x-jet-responsive-nav-link href="{{ route('template.index') }}" :active="request()->routeIs('template.index')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Templates') }}
                            </x-jet-responsive-nav-link>
                        </li> 
                         <li>
                             <x-jet-responsive-nav-link href="{{ route('paper.index') }}" :active="request()->routeIs('paper.index')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Paper Top Part') }}
                            </x-jet-responsive-nav-link>
                        </li>
                          <li>
                             <x-jet-responsive-nav-link href="{{ route('question.index') }}" :active="request()->routeIs('question.index')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Questions') }}
                            </x-jet-responsive-nav-link>
                        </li>
                        <li>
                             <x-jet-responsive-nav-link href="{{ route('question-paper.index') }}" :active="request()->routeIs('question-paper.index')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Question Papers') }}
                            </x-jet-responsive-nav-link>
                        </li>
                            </ul>
                        </li>

                         <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i> Assigned Papers
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
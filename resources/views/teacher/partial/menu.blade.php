 <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading">Menu</li>
                        <li>
                            {{-- <a href="{{route('school.dashboard')}}" class="mm-active" :active="request()->routeIs('dashboard')">
                                <i class="metismenu-icon pe-7s-rocket"></i> Dashboards
                            </a> --}}
                             <x-jet-responsive-nav-link href="{{ route('teacher.dashboard') }}" :active="request()->routeIs('teacher.dashboard')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Dashboard') }}
                            </x-jet-responsive-nav-link>
                        </li>
                         <li>
                             <x-jet-responsive-nav-link href="{{ route('teacher.classes') }}" :active="request()->routeIs('teacher.classes')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('View Classes') }}
                            </x-jet-responsive-nav-link>
                        </li>
                         <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i>View Students
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('teacher.students') }}" :active="request()->routeIs('admin.template.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('All') }}
                                    </x-jet-responsive-nav-link>
                                </li> 
                                 <li>
                                     <x-jet-responsive-nav-link href="{{ route('teacher.classes') }}" :active="request()->routeIs('admin.template.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Class/Section Wise') }}
                                    </x-jet-responsive-nav-link>
                                </li> 
                             {{--     <li>
                                     <x-jet-responsive-nav-link href="{{ route('teacher.students') }}" :active="request()->routeIs('admin.template.index')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Section Wise') }}
                                    </x-jet-responsive-nav-link>
                                </li>  --}}
                        
                            </ul>
                        </li>
                        <li class="@if(request()->routeIs('teacher.browse.papers') || request()->routeIs('teacher.assigned.papers')||request()->routeIs('teacher.recieved.papers')||request()->routeIs('teacher.recieved.papers')    || request()->routeIs('teacher.papers.archived')) mm-active @endif">
                            <a href="#" @if(request()->routeIs('teacher.browse.papers') || request()->routeIs('teacher.assigned.papers')||request()->routeIs('teacher.recieved.papers')
                            || request()->routeIs('teacher.recieved.papers')
                            || request()->routeIs('teacher.papers.sent_back')
                                || request()->routeIs('teacher.papers.archived')
                            ) aria-expanded="true" @endif>
                                <i class="metismenu-icon pe-7s-settings"></i>  Papers
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                             <li>
                             <x-jet-responsive-nav-link href="{{ route('teacher.browse.papers') }}" :active="request()->routeIs('teacher.browse.papers')" @i>
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Browse ') }} {!! auth()->user()->unreadNotifications->count()>0?'<span style="color:#red;" >('.auth()->user()->unreadNotifications->count().')</span>':''  !!}
                            </x-jet-responsive-nav-link>
                        </li>
                                 <li>
                             <x-jet-responsive-nav-link href="{{ route('teacher.assigned.papers') }}" :active="request()->routeIs('teacher.assigned.papers')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Assigned ') }}
                            </x-jet-responsive-nav-link>
                        </li>
                         <li>
                             <x-jet-responsive-nav-link href="{{ route('teacher.recieved.papers') }}" :active="request()->routeIs('teacher.recieved.papers')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Recieved ') }}
                            </x-jet-responsive-nav-link>
                        </li>
                         <li>
                             <x-jet-responsive-nav-link href="{{ route('teacher.papers.sent_back') }}" :active="request()->routeIs('teacher.papers.sent_back')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Sent') }}
                            </x-jet-responsive-nav-link>
                        </li> 
                               
                      
                         <li>
                             <x-jet-responsive-nav-link href="{{ route('teacher.papers.archived') }}" :active="request()->routeIs('teacher.papers.archived')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Archived ') }}
                            </x-jet-responsive-nav-link>
                        </li>
                            </ul>
                        </li>
                               <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i>Reports
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('teacher.class.reports') }}" :active="request()->routeIs('teacher.class.reports')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Class/Section-Wise') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('teacher.student.reports') }}" :active="request()->routeIs('teacher.student.reports')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Student-Wise') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                                 <li>
                                     <x-jet-responsive-nav-link href="{{ route('teacher.paper.reports') }}" :active="request()->routeIs('teacher.paper.reports')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Paper-Wise') }}
                                    </x-jet-responsive-nav-link>
                              </li>
                               
                            </ul>
                        </li>
                       
                         {{--      <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i> Recieved Papers
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('teacher.papers') }}" :active="request()->routeIs('teacher.papers')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('All') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                               
                            </ul>
                        </li> --}}
                         {{--    <li class="">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-settings"></i>Sent Back
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('teacher.papers.sent_back') }}" :active="request()->routeIs('teacher.papers.sent_back')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Recieved Papers') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                             
                              
                            </ul>
                        </li>
 --}}                         <li>
                             <x-jet-responsive-nav-link href="{{ route('teacher.students') }}" :active="request()->routeIs('teacher.students')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Feedback') }}
                            </x-jet-responsive-nav-link>
                        </li>

</ul>
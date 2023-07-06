 <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading">Menu</li>
                        <li>
                            {{-- <a href="{{route('school.dashboard')}}" class="mm-active" :active="request()->routeIs('dashboard')">
                                <i class="metismenu-icon pe-7s-rocket"></i> Dashboards
                            </a> --}}
                             <x-jet-responsive-nav-link href="{{ route('student.dashboard') }}" :active="request()->routeIs('student')">
                               <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Dashboard') }}
                            </x-jet-responsive-nav-link>
                        </li>
                          <li class="@if(request()->routeIs('student.papers.assign') || request()->routeIs('student.papers.saved')||request()->routeIs('student.papers.saved')||request()->routeIs('student.papers.sent') || request()->routeIs('student.papers.checked')) mm-active @endif">
                            <a href="#" @if(request()->routeIs('student.papers.assign') || request()->routeIs('student.papers.saved')||request()->routeIs('student.papers.saved')||request()->routeIs('student.papers.sent') || request()->routeIs('student.papers.checked')) aria-expanded="true" @endif>
                       
                                <i class="metismenu-icon pe-7s-settings"></i> Papers
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                               <!--     <li>
                                     <x-jet-responsive-nav-link href="{{ route('student.papers') }}" :active="request()->routeIs('student.papers')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('All') }}
                                    </x-jet-responsive-nav-link>
                              </li> --> 
                                <li>
                                     <x-jet-responsive-nav-link href="{{ route('student.papers.assign') }}" :active="request()->routeIs('student.papers.assign')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Inbox') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                               <li>
                                     <x-jet-responsive-nav-link href="{{ route('student.papers.saved') }}" :active="request()->routeIs('student.papers.saved')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Drafts') }}
                                    </x-jet-responsive-nav-link>
                              </li>  
                              <li>
                                     <x-jet-responsive-nav-link href="{{ route('student.papers.sent') }}" :active="request()->routeIs('student.papers.sent')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Sent') }}
                                    </x-jet-responsive-nav-link>
                              </li> 

                               <li>
                                     <x-jet-responsive-nav-link href="{{ route('student.papers.checked') }}" :active="request()->routeIs('student.papers.checked')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Archived') }}
                                    </x-jet-responsive-nav-link>
                              </li> 

                               <li>
                                     <x-jet-responsive-nav-link href="{{ route('student.papers.sent_back') }}" :active="request()->routeIs('student.papers.sent_back')">
                                       <i class="metismenu-icon pe-7s-rocket"></i>  {{ __('Correct Answers') }}
                                    </x-jet-responsive-nav-link>
                              </li> 
                              
                            </ul>
                        </li>
</ul>
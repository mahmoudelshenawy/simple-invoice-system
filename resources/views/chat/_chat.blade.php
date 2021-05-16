  <!-- row -->
  <div class="row row-sm main-content-app mb-4 mt-4">
    <div class="col-xl-4 col-lg-5">
        <div class="card">
            <div class="main-content-left main-content-left-chat">
                <nav class="nav main-nav-line main-nav-line-chat">
                    <a class="nav-link active" data-toggle="tab" href="">Recent Chat</a>
                </nav>
                <div class="main-chat-contacts-wrapper">
                    <label class="main-content-label main-content-label-sm">Active Contacts (5)</label>
                    <div class="main-chat-contacts" id="chatActiveContacts">
                        <div>
                            <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/3.jpg')}}"></div><small>Adrian</small>
                        </div>
                        
                        <div>
                            <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></div><small>George</small>
                        </div>
                        <div>
                            <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/15.jpg')}}"></div><small>Maryjane</small>
                        </div>
                    </div><!-- main-active-contacts -->
                </div><!-- main-chat-active-contacts -->
                <div class="main-chat-list" id="ChatList">
                    <div class="media new">
                        <div class="main-img-user online">
                            <img alt="" src="{{URL::asset('assets/img/faces/5.jpg')}}"> <span>2</span>
                        </div>
                        <div class="media-body">
                            <div class="media-contact-name">
                                <span>Socrates Itumay</span> <span>2 hours</span>
                            </div>
                            <p>Nam quam nunc, blandit vel aecenas et ante tincid</p>
                        </div>
                    </div>
                    <div class="media new">
                        <div class="main-img-user">
                            <img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"> <span>1</span>
                        </div>
                        <div class="media-body">
                            <div class="media-contact-name">
                                <span>Dexter dela Cruz</span> <span>3 hours</span>
                            </div>
                            <p>Maec enas tempus, tellus eget con dime ntum rhoncus, sem quam</p>
                        </div>
                    </div>
                    <div class="media selected">
                        <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/9.jpg')}}"></div>
                        <div class="media-body">
                            <div class="media-contact-name">
                                <span>Reynante Labares</span> <span>10 hours</span>
                            </div>
                            <p>Nam quam nunc, bl ndit vel aecenas et ante tincid</p>
                        </div>
                    </div>
                    <div class="media border-bottom-0">
                        <div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></div>
                        <div class="media-body">
                            <div class="media-contact-name">
                                <span>Samuel Lerin</span> <span>7 days</span>
                            </div>
                            <p>Nam quam nunc, blandit vel aecenas et ante tincid</p>
                        </div>
                    </div>
                </div><!-- main-chat-list -->
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <a class="main-header-arrow" href="" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
            <div class="main-content-body main-content-body-chat">
                <div class="main-chat-header">
                    <div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/faces/9.jpg')}}"></div>
                    <div class="main-chat-msg-name">
                        <h6>Reynante Labares</h6><small>Last seen: 2 minutes ago</small>
                    </div>
                    <nav class="nav">
                        <a class="nav-link" href=""><i class="icon ion-md-more"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Call"><i class="icon ion-ios-call"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Archive"><i class="icon ion-ios-filing"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Trash"><i class="icon ion-md-trash"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="View Info"><i class="icon ion-md-information-circle"></i></a>
                    </nav>
                </div><!-- main-chat-header -->
                <div class="main-chat-body" id="ChatBody">
                    <div class="content-inner">
                        <label class="main-chat-time"><span>3 days ago</span></label>
                        <div class="media flex-row-reverse">
                            <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/9.jpg')}}"></div>
                            <div class="media-body">
                                <div class="main-msg-wrapper right">
                                    Nulla consequat massa quis enim. Donec pede justo, fringilla vel...
                                </div>
                            
                                <div>
                                    <span>9:48 am</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></div>
                            <div class="media-body">
                                <div class="main-msg-wrapper left">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                                </div>
                                <div>
                                    <span>9:32 am</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-chat-footer">
                <nav class="nav">
                    <a class="nav-link" data-toggle="tooltip" href="" title="Add Photo"><i class="fas fa-camera"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Attach a File"><i class="fas fa-paperclip"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Add Emoticons"><i class="far fa-smile"></i></a> <a class="nav-link" href=""><i class="fas fa-ellipsis-v"></i></a>
                </nav><input class="form-control" placeholder="Type your message here..." type="text"> <a class="main-msg-send" href=""><i class="far fa-paper-plane"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<template>
  <div class="col-xl-8 col-lg-7">
    <div class="card">
      <a
        class="main-header-arrow"
        href=""
        id="ChatBodyHide"
      ><i class="icon ion-md-arrow-back"></i></a>
      <div class="main-content-body main-content-body-chat">
        <div class="main-chat-header">
          <div class="main-img-user">
            <img
              alt=""
              src="/Attachments/default.jpg"
            >
          </div>
          <div class="main-chat-msg-name">
            <h6>{{contact ? contact.name : 'select contact'}}</h6>
            <small>
              {{contact ? contact.email : ''}}
            </small>
          </div>
          <nav class="nav">
            <a
              class="nav-link"
              href=""
            ><i class="icon ion-md-more"></i></a> <a
              class="nav-link"
              data-toggle="tooltip"
              href=""
              title="Call"
            ><i class="icon ion-ios-call"></i></a> <a
              class="nav-link"
              data-toggle="tooltip"
              href=""
              title="Archive"
            ><i class="icon ion-ios-filing"></i></a> <a
              class="nav-link"
              data-toggle="tooltip"
              href=""
              title="Trash"
            ><i class="icon ion-md-trash"></i></a> <a
              class="nav-link"
              data-toggle="tooltip"
              href=""
              title="View Info"
            ><i class="icon ion-md-information-circle"></i></a>
          </nav>
        </div><!-- main-chat-header -->
        <div
          class="main-chat-body"
          id="ChatBody"
          ref="feed"
        >
          <div class="content-inner">
            <label class="main-chat-time"><span>3 days ago</span></label>
            <div
              v-for="message in messages"
              :key="message.id"
              :class="`media ${message.to == contact.id ?  'flex-row-reverse' : ''}`"
            >
              <div class="main-img-user online"><img
                  alt=""
                  src="/Attachments/default.jpg"
                ></div>
              <div class="media-body">
                <div class="main-msg-wrapper right">
                  {{message.message}}
                </div>

                <div>
                  <span>9:48 am</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                </div>
              </div>
            </div>
            <!-- <div class="media flex-row-reverse">
											<div class="main-img-user online"><img alt="" src="/Attachments/default.jpg"></div>
											<div class="media-body">
												<div class="main-msg-wrapper left">
													Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
												</div>
												<div>
													<span>9:32 am</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
												</div>
											</div>
										</div> -->
          </div>
        </div>
      </div>
      <!--  -->
      <chat-form @send="sendMessage"></chat-form>
    </div>
  </div>
</template>

<script>
import ChatForm from "./ChatForm";
export default {
  props: {
    contact: {
      type: Object,
      default: null,
    },
    messages: {
      type: Array,
      default: [],
    },
    user: {
      type: Object,
    },
  },
  components: { ChatForm },
  methods: {
    sendMessage(text) {
      if (!this.contact) {
        return;
      }
      axios
        .post(`/conversation/send`, {
          contact_id: this.contact.id,
          message: text,
        })
        .then((response) => {
          this.$emit("new", response.data);
        });
    },
    scrollToBottom() {
      setTimeout(() => {
        this.$refs.feed.scrollTop =
          this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 50);
    },
  },
  watch: {
    contact(contact) {
      this.scrollToBottom();
    },
    messages(messages) {
      this.scrollToBottom();
    },
  },
};
</script>
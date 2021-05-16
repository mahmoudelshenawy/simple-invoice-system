<template>
  <!-- row -->
  <div class="row row-sm main-content-app mb-4 mt-4">
    <ChatList
      :contacts="contacts"
      @selected="startConversationWith"
    />

    <ChatBody
      :user="user"
      :contact="selectedContact"
      :messages="messages"
      @new="saveNewMessages"
    />
  </div>
  <!-- row -->
</template>

<script>
import ChatBody from "./ChatBody.vue";
import ChatList from "./ChatList.vue";
export default {
  components: { ChatList, ChatBody },
  data() {
    return {
      messages: [],
      selectedContact: null,
    };
  },
  props: ["contacts", "user"],
  mounted() {
    Echo.private(`messages.${this.user.id}`).listen("NewMessage", (e) => {
      console.log(e);
      this.hanleIncoming(e.message);
    });
  },
  methods: {
    fetchMessages() {
      axios.get("/messages").then((response) => {
        this.messages = response.data;
      });
    },
    saveNewMessages(message) {
      this.messages.push(message);
    },
    hanleIncoming(message) {
      if (this.selectedContact && message.from == this.selectedContact.id) {
        this.saveNewMessage(message);
        return;
      }
    },
    startConversationWith(contact) {
      axios.get(`/conversation/${contact.id}`).then((response) => {
        this.messages = response.data;
        this.selectedContact = contact;
      });
    },
  },
};
</script>
<template>
    <div class="col-xl-4 col-lg-5">
						<div class="card">
							<div class="main-content-left main-content-left-chat">
								<nav class="nav main-nav-line main-nav-line-chat">
									<a class="nav-link active" data-toggle="tab" href="">Recent Chat</a>
								</nav>
								<div class="main-chat-contacts-wrapper">
									<label class="main-content-label main-content-label-sm">Active Contacts (5)</label>
									<div class="main-chat-contacts" id="chatActiveContacts">
										
									</div><!-- main-active-contacts -->
								</div><!-- main-chat-active-contacts -->
								<div class="main-chat-list" id="ChatList">
									<!-- <div class="media new">
										<div class="main-img-user online">
											<img alt="" src=""> <span>2</span>
										</div>
										<div class="media-body">
											<div class="media-contact-name">
												<span>Socrates Itumay</span> <span>2 hours</span>
											</div>
											<p>Nam quam nunc, blandit vel aecenas et ante tincid</p>
										</div>
									</div> -->
									<div v-for="contact in contacts" :key="contact.id" class="media new" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
										<div class="main-img-user">
											<img alt="" src="/Attachments/default.jpg"> <span>1</span>
										</div>
										<div class="media-body">
											<div class="media-contact-name">
												<span>{{contact.name}}</span> <span>3 hours</span>
											</div>
											<p>{{contact.email}}</p>
										</div>
									</div>
									<!-- <div class="media selected">
										<div class="main-img-user online"><img alt="" src=""></div>
										<div class="media-body">
											<div class="media-contact-name">
												<span>Reynante Labares</span> <span>10 hours</span>
											</div>
											<p>Nam quam nunc, bl ndit vel aecenas et ante tincid</p>
										</div>
									</div> -->
									<!-- <div class="media border-bottom-0">
										<div class="main-img-user"><img alt="" src=""></div>
										<div class="media-body">
											<div class="media-contact-name">
												<span>Samuel Lerin</span> <span>7 days</span>
											</div>
											<p>Nam quam nunc, blandit vel aecenas et ante tincid</p>
										</div>
									</div> -->
								</div><!-- main-chat-list -->
							</div>
						</div>
					</div>
</template>

<script>
export default {
    props:['contacts'],
	data(){
		return {
    selected: this.contacts.length ? this.contacts[0] : null 
    // selected:  null 
		}
	},
	methods :{
        selectContact(contact){
	this.selected = contact;
	this.$emit('selected',contact)
 }
	}
}
</script>
<template>
    	<div class="main-chat-footer">
								<nav class="nav">
									<a class="nav-link" data-toggle="tooltip" href="" title="Add Photo"><i class="fas fa-camera"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Attach a File"><i class="fas fa-paperclip"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Add Emoticons"><i class="far fa-smile"></i></a> <a class="nav-link" href=""><i class="fas fa-ellipsis-v"></i></a>
								</nav>
                                <input class="form-control" v-model="message" @keydown.enter="send" placeholder="Type your message here..." type="text">

                                 <a class="main-msg-send" href=""><i class="far fa-paper-plane"></i>
                                
                                </a>
							</div>
</template>

<script>
export default {
   data(){
return{
    message:''
}
   },
    methods:{
        send(e){
            e.preventDefault();
            
if(this.message === ''){
    return;
}
this.$emit('send',this.message)
this.message = ''
        }
    }
}
</script>
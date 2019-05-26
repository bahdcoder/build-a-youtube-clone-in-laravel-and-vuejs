<template>
    <div class="media my-3">
        <avatar :username="comment.user.name" class='mr-3' :size="30"></avatar>

        <div class="media-body">
            <h6 class="mt-0">
                {{ comment.user.name }}
            </h6>
            <small>
                {{ comment.body }}
            </small>
        
            <div class="d-flex">
                <votes :default_votes="comment.votes" :entity_id="comment.id" :entity_owner="comment.user.id"></votes>
                <button @click="addingReply = !addingReply" class="btn btn-sm ml-2" :class="{ 'btn-default': !addingReply, 'btn-danger': addingReply }">
                    {{ addingReply ? 'Cancel' : 'Add Reply' }}
                </button>
            </div>

            <div v-if="addingReply" class="form-inline my-4 w-full">
                <input v-model='body' type="text" class="form-control form-control-sm w-80">
                <button @click="addReply" class="btn btn-sm btn-primary">
                    <small>Add reply</small>
                </button>
            </div>
        
            <replies ref='replies' :comment="comment"></replies>
        </div>
    </div>
</template>


<script>
import Avatar from 'vue-avatar'
import Replies from './replies.vue'

 export default {
     components: {
         Avatar,
         Replies
     },
     data() {
         return {
             body: '',
             addingReply: false
         }
     },
     props: {
         comment: {
             required: true,
             default: () => ({})
         },
         video: {
             required: true,
             default: () => ({})
         }
     },
     methods: {
         addReply() {
             if (! this.body) return

             axios.post(`/comments/${this.video.id}`, {
                 comment_id: this.comment.id,
                 body: this.body
             }).then(({ data }) => {
                 this.body = ''
                 this.addingReply = false
                 this.$refs.replies.addReply(data)
             })
         }
     }
 }
</script>

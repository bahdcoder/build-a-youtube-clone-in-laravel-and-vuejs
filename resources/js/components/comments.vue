<template>
    <div class="card mt-5 p-5">
        <div v-if="auth" class="form-inline my-4 w-full">
                <input v-model="newComment" type="text" class="form-control form-control-sm w-80">
                <button @click="addComment" class="btn btn-sm btn-primary">
                    <small>Add comment</small>
                </button>
        </div>
        <div class="media my-3" v-for="comment in comments.data">
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
                    <button class="btn btn-sm btn-default ml-2">Add Reply</button>
                </div>
                <replies :comment="comment"></replies>
            </div>
        </div>

        <div class="text-center">
            <button v-if="comments.next_page_url" @click="fetchComments" class="btn btn-success">
                Load More
            </button>
            <span v-else>No more comments to show :)</span>
        </div>
    </div>
</template>

<script>
    import Avatar from 'vue-avatar'
    import Replies from './replies.vue'

    export default {
        props: ['video'],
        components: {
            Avatar,
            Replies
        },
        mounted() {
            this.fetchComments()
        },
        computed: {
            auth() {
                return __auth()
            }
        },
        data: () => ({
            comments: {
                data: []
            },
            newComment: ''
        }),
        methods: {
            fetchComments() {
                const url = this.comments.next_page_url ? this.comments.next_page_url : `/videos/${this.video.id}/comments`

                axios.get(url).then(({ data }) => {
                    this.comments = {
                        ...data,
                        data: [
                            ...this.comments.data,
                            ...data.data
                        ]
                    }
                })
            },
            addComment() {
                if (! this.newComment) return

                axios.post(`/comments/${this.video.id}`, {
                    body: this.newComment
                }).then(({ data }) => {
                    this.comments = {
                        ...this.comments,
                        data: [
                            data,
                            ...this.comments.data
                        ]
                    }
                })
            }
        }
    }
</script>

<template>
    <div class="component-container">
        <div class="input-group mb-5" v-if="userAuthenticated">
            <textarea class="form-control" v-model="commentBody"></textarea>
            <div class="input-group-append">
                <button class="btn" type="button" id="button-addon2" @click.prevent="submit">Envoyer !</button>
            </div>
        </div>
        <ul class="list-unstyled">
            <li class="media mb-4" v-for="comment in commentaries" :key="comment.id">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">
                        {{ `${comment.user.fname} ${comment.user.lname}` }}
                        <div class="col-md-2 text-left my-2" style="border-top: 1px solid #e5e5e5;">
                        </div>
                    </h5>
                    <p class="lead float-left">{{ comment.body }}</p>
                    <a href="#" @click.prevent="destroy(comment)" class="btn btn-sm btn-danger float-right" v-if="userAuthenticated && comment.user.id == userId">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            comments: {
                required: true,
                type: Array
            },
            model: {
                required: true
            },
            submitUrl: {
                required: true
            },
            deleteUrl: {
                required: true
            },
            userId: {
                default: false
            }
        },

        data () {
            return {
                commentBody: null
            }
        },

        computed: {
            commentaries () {
                return this.comments
            },

            userAuthenticated () {
                return this.userId
            }
        },

        methods: {
            submit () {
                axios.post(this.submitUrl, {
                    model: this.model,
                    body: this.commentBody
                }).then(({data}) => {
                    this.comments.unshift(data)
                    this.commentBody = null
                })
            },

            destroy ({id}) {
                axios.delete(this.deleteUrl + '')
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>


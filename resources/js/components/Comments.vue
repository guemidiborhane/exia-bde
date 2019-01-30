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
                        <a href="#" @click.prevent="report(comment)"
                            class="btn btn-sm btn-primary float-right" v-if="userAuthenticated && userRole === 'staff'">
                            <i class="fa fa-flag"></i>
                        </a>
                        <div class="col-md-2 text-left my-2" style="border-top: 1px solid #e5e5e5;">
                        </div>
                    </h5>
                    <p class="lead float-left">{{ comment.body }}</p>
                    <div class="float-right">
                        <a href="#" @click.prevent="destroy(comment)" class="btn btn-sm btn-danger" v-if="userAuthenticated && comment.user.id == userId">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
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
            },
            userRole: {
                type: String
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
            },
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
                axios.delete(this.deleteUrl + '/' + id).then(response => {
                    this.removeComment(id)
                })
            },

            removeComment (id) {
                let index = this.comments.map(comment => comment.id).indexOf(id)
                this.comments.splice(index, 1)
                this.$forceUpdate()
            },

            report ({id}) {
                console.log(id)
                if (this.userRole === 'staff') {
                    axios.delete(this.deleteUrl + '/' + id, {
                        data: { report: true }
                    }).then(response => {
                        this.removeComment(id)
                    })
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>


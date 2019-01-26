<template>
    <div class="component-container">
        <ul class="list-unstyled">
            <li class="media mb-4" v-for="comment in comments" :key="comment.id">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">
                        {{ `${comment.user.fname} ${comment.user.lname}` }}
                        <div class="col-md-2 text-left my-2" style="border-top: 1px solid #e5e5e5;">
                        </div>
                    </h5>
                    <p class="lead">{{ comment.body }}</p>
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
            submitUrl: {
                required: true
            }
        },

        methods: {
            submit () {
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>


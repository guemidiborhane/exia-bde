<template>
    <div class="component-container btn-group">
        <a href="#"
            @click.prevent="submit"
            :class="['submission-btn', 'btn', 'btn-sm', liked ? 'btn-danger' : 'btn-outline-danger', 'mr-2']">
            <i class="fa fa-heart fa-lg"></i>
            <span>{{ likesCount }}</span>
        </a>
    </div>
</template>

<script>
    export default {
        props: {
            eventId: {
                required: true,
                type: Number
            },
            liked: {
                required: true,
                type: Boolean
            },
            likesCount: {
                required: true,
                type: Number
            },
            submitRoute: {
                required: true
            }
        },

        methods: {
            submit () {
                axios.post(this.submitRoute).then(response => {
                    let data = response.data
                    this.liked = !this.liked
                    this.likesCount = data.likesCount;
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
.counter {
    font-size: 12px;
    opacity: 1;
}

.submission-btn:focus {
    box-shadow: none !important;
}
</style>


<template>
    <div class="component-container btn-group">
        <a href="#"
            @click.prevent="submit"
            :class="['submission-btn', 'btn', 'btn-sm', participates ? 'btn-outline-primary' : 'btn-outline-warning']">
            {{ (participates) ? 'Ne plus participer' : 'Participer' }}
        </a>
        <span class="btn btn-sm btn-warning counter disabled">{{ participantsCount }}</span>
    </div>
</template>

<script>
    export default {
        props: {
            eventId: {
                required: true,
                type: Number
            },
            participates: {
                required: true,
                type: Boolean
            },
            participantsCount: {
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
                    if (data.action === 'attach') {
                        this.participates = true;
                    } else if (data.action === 'detach') {
                        this.participates = false;
                    }
                    this.participantsCount = data.participantsCount;
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


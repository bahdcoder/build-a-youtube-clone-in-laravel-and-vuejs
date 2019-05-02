<template>
    <button @click="toggleSubscription" class="btn btn-danger">
        {{ owner ? '' : subscribed ? 'Unsubscribe' : 'Subscribe' }} {{ count }} {{ owner ? 'Subscribers' : '' }}
    </button>
</template>

<script>
import numeral from 'numeral'

export default {
    props: {
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        },
        initialSubscriptions: {
            type: Array,
            required: true,
            default: () => []
        }
    },

    data: function () {
        return { 
            subscriptions: this.initialSubscriptions
        }
    },

    computed: {
        subscribed() {
            if (! __auth() || this.channel.user_id === __auth().id) return false

            return !!this.subscription
        },

        owner() {
            if (__auth() && this.channel.user_id === __auth().id) return true

            return false
        },

        subscription() {
            if (! __auth()) return null

            return this.subscriptions.find(subscription => subscription.user_id === __auth().id)
        },

        count() {
            return numeral(this.subscriptions.length).format('0a')
        }
    },
    methods: {
        toggleSubscription() {
            if (! __auth()) {
                return alert('Please login to subscribe.')
            }

            if (this.owner) {
                return alert('You cannot subscribe to your channel.')
            }

            if (this.subscribed) {
                axios.delete(`/channels/${this.channel.id}/subscriptions/${this.subscription.id}`)
                    .then(() => {
                        this.subscriptions = this.subscriptions.filter(s => s.id !== this.subscription.id)
                    })
            } else {
                axios.post(`/channels/${this.channel.id}/subscriptions`)
                    .then(response => {
                        this.subscriptions = [
                            ...this.subscriptions,
                            response.data
                        ]
                    })
            }
        }
    }
}
</script>


import numeral from 'numeral'

Vue.component('subscribe-button', {
    props: {
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        },
        subscriptions: {
            type: Array,
            required: true,
            default: () => []
        }
    },

    computed: {
        subscribed() {
            if (! __auth() || this.channel.user_id === __auth().id) return false

            return !!this.subscriptions.find(subscription => subscription.user_id === __auth().id)
        },

        owner() {
            if (__auth() && this.channel.user_id === __auth().id) return true

            return false
        },

        count() {
            return numeral(this.subscriptions.length).format('0a')
        }
    },
    methods: {
        toggleSubscription() {
            if (! __auth()) {
                alert('Please login to subscribe.')
            }
        }
    }
})

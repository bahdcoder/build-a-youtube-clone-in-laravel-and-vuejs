Vue.component('channel-uploads', {
    props: {
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        }
    },
    data: () => ({
        selected: false,
        videos: []
    }),

    methods: {
        upload() {
            this.selected = true
            this.videos = Array.from(this.$refs.videos.files)

            const uploaders = this.videos.map(video => {
                const form = new FormData()

                form.append('video', video)
                form.append('title', video.name)

                return axios.post(`/channels/${this.channel.id}/videos`, form)
            })
        }
    }
})

<template>
    <div class="
        flex
        flex-col sm:flex-row
        items-center sm:justify-around
        space-y-4 sm:space-y-0
        mt-4 sm:mt-10 sm:mx-32
    ">
        <button class="btn-primary w-full sm:w-32" @click="switchOnJoinPanel">
            Rejoindre
            <i class="fa-solid fa-magnifying-glass-arrow-right"></i>
        </button>
        <button class="btn-primary w-full sm:w-32" @click="switchOnStorePanel">
            Créer
            <i class="fa-solid fa-circle-plus"></i>
        </button>
    </div>
    <join-panel
        :shown="showJoinPanel"
        :recommended-leagues="data.recommendedLeagues"
        :url-join="urlJoin"
        :url-show="urlShow"
        @close="showJoinPanel = !showJoinPanel"
    ></join-panel>
    <store-panel
        :shown="showStorePanel"
        :url-store="urlStore"
        :url-show="urlShow"
        @close="(showStorePanel = !showStorePanel)"
    ></store-panel>
    <hr>
    <div v-if="loading" class="flex justify-center mt-10">
        <svg aria-hidden="true" class="mr-2 w-8 h-8 text-gray animate-spin fill-cyan" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
    </div>
    <div class="
        my-4 sm:my-10 sm:mx-8
        grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4
    ">
        <div class="mb-4 flex justify-center" v-for="league in data.leagues">
            <a :href="trimmedUrlShow + league.code">
                <card-league
                    :league="league"
                    :can-be-favorite="true"
                    :favorite="league.favorite ? true : false"
                    :url-favorite="urlFavorite"
                ></card-league>
            </a>
        </div>
    </div>
</template>

<script>
import CardLeague from './CardLeague.vue'
import JoinPanel from "./JoinPanel.vue"
import StorePanel from "./StorePanel.vue"
import 'axios'

export default {
    components: {
        JoinPanel,
        StorePanel,
        CardLeague,
    },
    props: {
        urlBrowse: String,
        urlFavorite: String,
        urlJoin: String,
        urlStore: String,
        urlShow: String
    },
    data() {
        return {
            showJoinPanel: false,
            showStorePanel: false,
            data: [],
            loading: false,
            trimmedUrlShow: ''
        }
    },
    methods: {
        load: async function () {
            this.loading = true

            await axios
                .get(this.urlBrowse)
                .then(response => (
                    this.data = response.data
                ))
            
            this.loading = false
        },
        switchOnJoinPanel () {
            if (!this.loading) {
                this.showStorePanel = false
                this.showJoinPanel = !this.showJoinPanel
            }
        },
        switchOnStorePanel () {
            if (!this.loading) {
                this.showJoinPanel = false
                this.showStorePanel = !this.showStorePanel
            }
        }
    },
    mounted() {
        this.load()
        this.trimmedUrlShow = this.urlShow.slice(0, -1)
    },
}
</script>
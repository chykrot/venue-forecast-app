<template>
  <div>
    <div
      v-if="showModal"
      class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex p-6 lg:p-20"
    >
      <div class="relative w-auto my-6 mx-auto max-w-6xl">
        <!--content-->
        <div
          class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"
        >
          <div
            class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t"
          >
            <h3 class="text-xl font-semibold">{{ venueDetail.name }}</h3>
          </div>
					<div>
						<img class="object-contain w-full" :src="venueDetail.bestPhoto.prefix + venueDetail.bestPhoto.width +'x' + venueDetail.bestPhoto.height + venueDetail.bestPhoto.suffix">
					</div>

					<div v-if="venueDetail.description" class="relative pt-6 px-6 flex-auto">
						<p>Description</p>
            <p class="my-4 text-gray-600 text-md leading-relaxed">
							{{ venueDetail.description }}
						</p>
          </div>

					<div v-if="venueDetail.tips.count" class="relative pt-6 px-6 flex-auto">
						<p>Tips</p>
						<div v-for="groups in venueDetail.tips.groups" :key="groups.name">
							<p v-for="item in groups.items" :key="item.id" class="my-4 text-gray-600 text-md leading-relaxed">
								{{ item.text }}
							</p>
						</div>
          </div>

					<div v-if="venueDetail.hours" class="relative pt-6 px-6 flex-auto">
						<p>Hours</p>
						<p class="my-2 text-gray-600 text-md leading-relaxed">{{ venueDetail.hours.status }}</p>
						<div v-for="timeframe in venueDetail.hours.timeframes" :key="timeframe.days">
							<p v-for="item in timeframe.open" :key="item.renderedTime" class="my-2 text-gray-600 text-md leading-relaxed">
								{{ timeframe.days }} {{ item.renderedTime }}
							</p>
						</div>
          </div>
					
          <div
            class="flex items-center justify-end p-5 border-t border-solid border-gray-300 rounded-b"
          >
            <button
              class="text-blue-500 bg-transparent border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-sm px-5 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
              type="button"
              style="transition: all 0.15s ease"
              v-on:click="toggleModal()"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      v-if="showModal"
      class="opacity-50 fixed inset-0 z-40 bg-black"
    ></div>
  </div>
</template>

<script>

import bus from '../utility/bus'

export default {
  name: "modal-details",
	props: ['details'],
	mounted() {
		bus.$on('previewVenue', (payload) => {
      this.showLocation(payload)
    })
	},
  data() {
    return {
			venueDetail: {},
			showModal: false
		}
  },
  methods: {
    toggleModal() {
      this.showModal = !this.showModal;
		},
		showLocation(venueId) {
			axios
				.get(`api/location/${venueId}`)
				.then(result => {
					this.venueDetail = result.data.venue
					this.showModal = !this.showModal

					console.log(this.venueDetail)
				})
				.catch(error => {
					console.log(error)
					bus.$emit('modalError', true)
				})
    }
  },
};
</script>
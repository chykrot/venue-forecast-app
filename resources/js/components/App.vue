<template>
	<div>

		<div class="container mx-auto">
			<div class="flex items-center justify-center px-3 pt-10">
				<div class="flex bg-white rounded p-6 w-full">
          <div class="flex flex-col bg-white w-3/4 pr-3">
            <label class="block">
              <span class="text-gray-700">{{ $t('selectCity') }}</span>
              <select 
                @change="onChangeLocation($event)"
                v-model="selectedLocation"
                class="form-select block p-2 rounded border-2 border-light-blue-500 border-opacity-75 w-full mt-1 cursor-pointer"
              >
                <option 
                  v-for="location in locations" :key="location.city" 
                  :value="location"
                  class="mx-4"
                >
                  {{ location.city }}
                </option>
              </select>
            </label>
          </div>

          <div class="flex flex-col bg-white w-1/4 pl-3">
            <label class="block">
              <span class="text-gray-700">{{ $t('language') }}</span>
              <select 
                @change="onChangeLanguage($event)"
                v-model="selectedLanguage"
                class="form-select block p-2 rounded border-2 border-light-blue-500 border-opacity-75 w-full mt-1 cursor-pointer"
              >
                <option 
                  v-for="language in languages" :key="language.code" 
                  :value="language"
                  class="mx-4"
                >
                  {{ language.name }}
                </option>
              </select>
            </label>
          </div>
        </div>
			</div>

			<div v-if="city" class="flex flex-wrap lg:flex-row-reverse">
        <div class="w-full lg:w-1/3">
					<section class="py-6 xl:bg-contain bg-top bg-no-repeat"
						style="background-image: url('metis-assets/backgrounds/intersect.svg');">
						<div class="container mx-auto">
							<forecast 
                v-for="(forecast, index) in forecasts" :key="forecast.clouds.dt"
                :forecast="forecast" :index="index"
              >
              </forecast>
						</div>
					</section>
				</div>

				<div class="w-full lg:w-2/3">
					<section class="py-6 px-3 overflow-x-hidden">
						<div class="container p-6 mx-auto bg-white shadow rounded">	
							<div class="pb-6">
								<span class="text-2xl text-blue-600 font-semibold">{{ $t('venue') }}</span>
							</div>
							<venue v-for="venue in venues" :key="venue.id" :venue="venue" :lang="selectedLanguage.code">
                <Map :coordinates="{ lat:venue.location.lat, lng:venue.location.lng }" />
              </venue>
						</div>
            <div class="text-center py-10 cursor-pointer">
              <a 
                class="inline-block py-4 px-8 text-xs text-white font-semibold leading-none bg-blue-600 hover:bg-blue-700 rounded"
                @click="loadMore()"
              >
                {{ $t('loadMore') }}...
              </a>
            </div>
					</section>
				</div>
			</div>
		</div>

    <modal-details></modal-details>

    <modal-error></modal-error>

	</div>
</template>

<script>

import Map from './Map.vue'
import Venue from './Venue.vue'
import Forecast from './Forecast.vue'
import ModalDetails from './ModalDetails.vue'
import ModalError from './ModalError.vue'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css' 
import i18n from '../utility/i18n'
import bus from '../utility/bus'

export default {
	components: {
    Map,
    Venue,
    Forecast,
    ModalDetails,
    ModalError
	},
  computed: {},
	data() {
		return {
      city: null,
      venues: [],
			forecasts: [],
			selectedLocation: {city:'Tokyo', state:'JP'},
			locations: [
				{city:'Tokyo', state:'JP'},
				{city:'Yokohama', state:'JP'},
				{city:'Kyoto', state:'JP'},
				{city:'Osaka', state:'JP'},
				{city:'Sapporo', state:'JP'},
				{city:'Nagoya', state:'JP'}
      ],
      locationsLimit: 5,
      selectedLanguage: {code: 'en', name: 'English'},
      languages: [
        {code: 'en', name: 'English'},
        {code: 'ja', name: 'Japanese'}
      ]
		}
	},
	mounted () {
    this.fetchData()
	},
	methods: {
		dayOfWeek(dateStr) {
			const newDate = new Date(dateStr)			
			return daysOfWeek[newDate.getDay()]
		},		
		weatherLocation() {
      return axios
        .get(`api/weather?location=${this.selectedLocation.city},${this.selectedLocation.state}&lang=${this.selectedLanguage.code}`)
		},
		searchLocation() {
      return axios
        .get(`api/location?location=${this.selectedLocation.city},${this.selectedLocation.state}&lang=${this.selectedLanguage.code}&limit=${this.locationsLimit}`)
    },
    fetchData() {
      NProgress.start()
      let location = this.searchLocation()
      let weather = this.weatherLocation()
      
      Promise.all([location, weather])
      .then((result) => {
        this.city = result[0].data.geocode
        this.venues = result[0].data.venues
        this.forecasts = result[1].data.list
        NProgress.done()
      })
      .catch((error) => {
        console.log(`Error in promises ${error}`)
        bus.$emit('modalError', true)
        NProgress.done()
      })
    },
		onChangeLocation(event) {
      this.fetchData()
    },
    onChangeLanguage(event) {
      i18n.locale = this.selectedLanguage.code
      this.fetchData()
    },
    loadMore() {
      this.locationsLimit = this.locationsLimit + 5
      this.searchLocation().then(result => {
        this.venues = result.data.venues
      })
      .catch(error => console.log(error))
    }
	}
}
</script>
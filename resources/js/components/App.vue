<template>
	<div>

		<div class="container mx-auto">
			<div class="flex items-center justify-center px-3 pt-10">
				<div class="flex flex-col bg-white rounded p-6 w-full">
					<label class="block">
						<span class="text-gray-700">Select City</span>
						<select 
							@change="onChangeLocation($event)"
							v-model="selectedLocation"
							class="form-select block p-2 rounded border-2 border-light-blue-500 border-opacity-75 w-full mt-1"
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
          <label class="block">
						<span class="text-gray-700">Select Language</span>
						<select 
							@change="onChangeLanguage($event)"
							v-model="selectedLanguage"
							class="form-select block p-2 rounded border-2 border-light-blue-500 border-opacity-75 w-full mt-1"
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

			<div class="flex flex-wrap lg:flex-nowrap">
				<div class="w-full lg:w-2/3">
					<section class="py-6 px-3 overflow-x-hidden">
						<div class="container p-6 mx-auto bg-white shadow rounded">	
							<div class="pb-6">
								<span class="text-2xl text-blue-600 font-semibold">Landmark</span>
							</div>
							<venue v-for="venue in venues" :key="venue.id" :venue="venue">
                <Map :coordinates="{ lat:venue.location.lat, lng:venue.location.lng }" />
              </venue>
						</div>
					</section>
				</div>

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
			</div>
		</div>

	</div>
</template>

<script>

import Map from './Map.vue';
import Venue from './Venue.vue';
import Forecast from './Forecast.vue';
import NProgress from 'nprogress'
import 'nprogress/nprogress.css' 

export default {
	components: {
    Map,
    Venue,
    Forecast
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
      selectedLanguage: {code: 'ja', name: 'Japanese'},
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
        .get(`api/location?location=${this.selectedLocation.city},${this.selectedLocation.state}&locale=${this.selectedLanguage.code}`)
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
        NProgress.done()
      })
    },
		onChangeLocation(event) {
      this.fetchData()
    },
    onChangeLanguage(event) {
      this.fetchData()
    }
	}
}
</script>
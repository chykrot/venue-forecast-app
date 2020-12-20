<template>
	<div>

		<div class="container mx-auto">
			<div class="flex items-center justify-center px-3 pt-10">
				<div class="flex flex-col bg-white rounded p-6 w-full">
					<label class="block">
						<span class="text-gray-700">Select City</span>
						<select 
							@change="onChange($event)"
							v-model="selectedLocation"
							class="form-select block p-2 rounded border-2 border-light-blue-500 border-opacity-75 w-full mt-1"
						>
							<option 
								v-for="item in locations" :key="item.city" 
								:value="item"
								class="mx-4"
							>
								{{ item.city }}
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
import venue from './Venue.vue';
import forecast from './Forecast.vue';

export default {
	components: {
    Map,
    venue,
    forecast
	},
	computed: {},
	data() {
		return {
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
			]
		}
	},
	mounted () {
		this.weatherLocation()
		this.searchLocation()
	},
	methods: {
		dayOfWeek(dateStr) {
			const daysOfWeek = ["Sunday", 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
			const newDate = new Date(dateStr)			
			return daysOfWeek[newDate.getDay()]
		},		
		weatherLocation() {
			axios
			.get(`api/weather?location=${this.selectedLocation.city},${this.selectedLocation.state}`)
			.then(response => {
				this.city = response.data.city
				this.forecasts = response.data.list
			})
		},
		searchLocation() {
			axios.get(`api/location?location=${this.selectedLocation.city},${this.selectedLocation.state}`)
			.then(response => {
				this.city = response.data.response.geocode
				this.venues = response.data.response.venues
			})
		},
		onChange(event) {
			this.weatherLocation()
			this.searchLocation()
    }
	}
}
</script>
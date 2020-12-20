<template>
  <div>
    <div class="flex flex-wrap max-w-5xl mx-auto">
			<div class="w-full px-3 mb-3">
				<div class="p-6 bg-white shadow rounded">
					<div class="font-bold text-lg">{{ index == 0 ? 'Today' : dateString(forecast.dt_txt) }}</div>
					
					<div class="flex flex-row justify-between mt-2">
						<div class="flex flex-col items-center">
							<div class="font-medium text-4xl text-blue-600">{{ Math.round(forecast.main.temp) }}°C</div>
						</div>
						<div class="flex flex-col items-center">
							<div v-for="weather in forecast.weather" :key="weather.id">
								<div class="text-6xl items-center">
									<img :src="imageIcon(weather.icon, 2)">
								</div>
								<div class="text-center">{{ weather.description }}</div>
							</div>
						</div>
						<div class="flex flex-col items-center">
							<div class="mt-1">
								<span class="text-sm"><i class="far fa-long-arrow-up"></i></span>
								<span class="text-sm font-light text-gray-500">min {{ forecast.main.temp_max.toFixed() }}°C</span>
							</div>
							<div>
								<span class="text-sm"><i class="far fa-long-arrow-down"></i></span>
								<span class="text-sm font-light text-gray-500">max {{ forecast.main.temp_min.toFixed() }}°C</span>
							</div>
						</div>
					</div>
					<div class="flex flex-row justify-between mt-6">
						<div class="flex flex-col items-center">
							<div class="font-medium text-sm">Wind</div>
							<div class="text-sm text-gray-500">{{ forecast.wind.speed.toFixed(1) }}k/h</div>
						</div>
						<div class="flex flex-col items-center">
							<div class="font-medium text-sm">Humidity</div>
							<div class="text-sm text-gray-500">{{ forecast.main.humidity }}%</div>
						</div>
						<div class="flex flex-col items-center">
							<div class="font-medium text-sm">Visibility</div>
							<div class="text-sm text-gray-500">10km</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
</template>

<script>

export default {
  props: [
		'forecast',
		'index'
  ],
  name: 'forecast',
  data() {
    return {

		}
	},
	methods: {
		imageIcon(icon, size) {
			return 'http://openweathermap.org/img/wn/' + icon + '.png'
		},
		dateString(dateStr) {
			return new Date(dateStr).toDateString()
		}
	}

}
</script>

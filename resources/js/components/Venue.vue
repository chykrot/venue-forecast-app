<template>
  <div>
    <div class="flex flex-wrap">
			<div class="w-full border-t"></div>
			<div class="w-full lg:w-1/2">
				<div class="py-4 lg:pr-6">
					<div class="mb-4">
						<h3 class="text-xl mt-3 font-bold font-heading">{{ venue.name }}</h3>
					</div>
					<div class="flex items-start">
						<div class="w-7 mt-1 mr-5 text-blue-500">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
							</svg>
						</div>
						<div>
							<h3 class="text-lg font-semibold font-heading">{{ $t('address') }}</h3>
							<p class="text-gray-600 leading-loose">
								{{ venue.location.formattedAddress.join(' ') }}
							</p>
						</div>
					</div>
					<div class="flex items-start">
						<div class="w-6 mt-1 mr-5 text-blue-500">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
							</svg>
						</div>
						<div>
							<h3 class="text-lg font-semibold font-heading">{{ $t('category') }}</h3>
							<div v-for="category in venue.categories" :key="category.id">
								<p class="text-gray-600 leading-loose">
									{{ category.name }}
								</p>
							</div>
						</div>
					</div>
					<div class="flex items-start">
						<div class="w-6 mt-1 mr-5 text-blue-500">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
							</svg>
						</div>
						<div>
							<h3 class="text-lg font-semibold font-heading">{{ $t('coordinates') }}</h3>
							<p class="text-gray-600 leading-loose">
								<span class="text-blue-500">{{ $t('latitude') }} : </span> {{ venue.location.lat }}
							</p>
							<p class="text-gray-600 leading-loose text-md">
								<span class="text-blue-500">{{ $t('longitude') }} : </span> {{ venue.location.lng }}
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="relative w-full lg:w-1/2 py-6">
				<slot></slot>
			</div>
		</div>
  </div>
</template>

<script>

export default {
  props: [
      'venue'
  ],
  name: 'venue',
  data() {
      return {

      }
  }
}
</script>


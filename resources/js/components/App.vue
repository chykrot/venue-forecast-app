<template>
  <div>
    <div class="flex items-center justify-center p-2">
      <div class="flex flex-col bg-white rounded p-2 w-full max-w-lg">
        <label class="block">
          <span class="text-gray-700">Select City</span>
          <select
            @change="onChange($event)"
            v-model="selectedLocation"
            class="form-select block p-2 rounded border-2 border-light-blue-500 border-opacity-75 w-full mt-1"
          >
            <option
              v-for="item in locations"
              :key="item.city"
              :value="item"
              class="mx-4"
            >
              {{ item.city }}
            </option>
          </select>
        </label>
      </div>
    </div>

    <div class="container mx-auto">
      <div class="flex flex-wrap lg:flex-nowrap">
        <div class="w-full">
          <section
            class="py-20 xl:bg-contain bg-top bg-no-repeat"
            style="
              background-image: url('metis-assets/backgrounds/intersect.svg');
            "
          >
            <div class="container px-4 mx-auto">
              <div
                v-for="(item, index) in list"
                :key="item.clouds.dt"
                class="flex flex-wrap max-w-5xl mx-auto"
              >
                <div class="w-full px-3 mb-3">
                  <div class="p-6 bg-white shadow rounded">
                    <div class="font-bold text-lg">
                      {{ index == 0 ? "Today" : dateString(item.dt_txt) }}
                    </div>

                    <div class="flex flex-row justify-between mt-2">
                      <div class="flex flex-col items-center">
                        <div class="font-medium text-4xl text-blue-600">
                          {{ Math.round(item.main.temp) }}°C
                        </div>
                      </div>
                      <div class="flex flex-col items-center">
                        <div v-for="weather in item.weather" :key="weather.id">
                          <div class="text-6xl items-center">
                            <img :src="imageIcon(weather.icon, 2)" />
                          </div>
                          <div class="text-center">
                            {{ weather.description }}
                          </div>
                        </div>
                      </div>
                      <div class="flex flex-col items-center">
                        <div class="mt-1">
                          <span class="text-sm"
                            ><i class="far fa-long-arrow-up"></i
                          ></span>
                          <span class="text-sm font-light text-gray-500"
                            >min {{ item.main.temp_max.toFixed() }}°C</span
                          >
                        </div>
                        <div>
                          <span class="text-sm"
                            ><i class="far fa-long-arrow-down"></i
                          ></span>
                          <span class="text-sm font-light text-gray-500"
                            >max {{ item.main.temp_min.toFixed() }}°C</span
                          >
                        </div>
                      </div>
                    </div>

                    <div class="flex flex-row justify-between mt-6">
                      <div class="flex flex-col items-center">
                        <div class="font-medium text-sm">Wind</div>
                        <div class="text-sm text-gray-500">
                          {{ item.wind.speed.toFixed(1) }}k/h
                        </div>
                      </div>
                      <div class="flex flex-col items-center">
                        <div class="font-medium text-sm">Humidity</div>
                        <div class="text-sm text-gray-500">
                          {{ item.main.humidity }}%
                        </div>
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
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const default_layout = "default";

export default {
  components: {
    Map,
  },
  computed: {},
  data() {
    return {
      city: null,
      list: [],
      selectedLocation: { city: "Tokyo", state: "JP" },
      locations: [
        { city: "Tokyo", state: "JP" },
        { city: "Yokohama", state: "JP" },
        { city: "Kyoto", state: "JP" },
        { city: "Osaka", state: "JP" },
        { city: "Sapporo", state: "JP" },
        { city: "Nagoya", state: "JP" },
      ],
    };
  },
  mounted() {
    this.weatherLocation();
  },
  methods: {
    dayOfWeek(dateStr) {
      const daysOfWeek = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
      ];
      const newDate = new Date(dateStr);
      return daysOfWeek[newDate.getDay()];
    },
    dateString(dateStr) {
      return new Date(dateStr).toDateString()
    },
    imageIcon(icon, size) {
      return "http://openweathermap.org/img/wn/" + icon + ".png";
    },
    weatherLocation() {
      axios
        .get(
          `api/weather?location=${this.selectedLocation.city},${this.selectedLocation.state}`
        )
        .then((response) => {
          this.city = response.data.city
          this.list = response.data.list
        });
		},
    onChange(event) {
			this.weatherLocation()
    },
  },
};
</script>
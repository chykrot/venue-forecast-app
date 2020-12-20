<template>
  <div>
    <div
      v-if="showModal"
      class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex p-6 sm:p-20 lg:p-40"
    >
      <div class="relative w-auto my-6 mx-auto max-w-6xl">
        <div
          class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"
        >
          <div
            class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t"
          >
            <h3 class="text-xl font-semibold text-red-500">Error</h3>
          </div>
          <div class="relative p-6 flex-auto">
            <p>Whoops, something went wrong...</p>
            <p class="my-4 text-gray-600 text-md leading-relaxed">
              Unexpected Error or Reach API Quota Limit
            </p>
            <p class="my-4 text-gray-600 text-md leading-relaxed">
              Please try again later.
            </p>
          </div>

          <div
            class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b"
          >
            <button
              class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
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
    <div v-if="showModal" class="opacity-50 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>

<script>
import bus from "../utility/bus";

export default {
  name: "modal-error",
  mounted() {
    bus.$on("modalError", (payload) => {
      this.toggleModal();
    });
  },
  data() {
    return {
      showModal: false,
    };
  },
  methods: {
    toggleModal() {
      this.showModal = !this.showModal;
    },
  },
};
</script>

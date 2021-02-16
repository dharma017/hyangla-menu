<template>
  <div>
    <div
      class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400"
      v-if="isOpen"
    >
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <div class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span
        >​
        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-lg">
            <button
              aria-label="close"
              class="absolute top-0 right-0 text-3xl text-gray-500 my-2 mx-4"
              @click="closeModal()"
            >
              ×
            </button>
            <div class="modal-body">
              <img
                class="object-contain w-full"
                slot="body"
                v-if="menu.marketing_image"
                :src="menu.marketing_image"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400"
      v-if="isOrgOpen"
    >
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <div class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span
        >​
        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-lg">
            <button
              aria-label="close"
              class="absolute top-0 right-0 text-3xl text-gray-500 my-2 mx-4"
              @click="closeOrganizationModal()"
            >
              ×
            </button>
            <div class="modal-body">
              <img
                class="object-contain w-full"
                slot="body"
                v-if="organization.marketing_image"
                :src="organization.marketing_image"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <img class="object-contain w-full" v-if="menu.image" :src="menu.image" />
  </div>
</template>

<script>
export default {
  metaInfo: { title: "Hyangla Menu" },
  props: {
    menu: Object,
    organization: Object,
  },
  data() {
    return {
      isOpen: false,
      isOrgOpen: false,
    };
  },
  created() {
    if (this.organization.enable_marketing) {
      this.openOrganizationModal();
    } else {
      if (this.menu.enable_marketing) {
        this.openModal();
      }
    }
  },
  destroyed() {
    console.log("Component has been destroyed!");
  },
  methods: {
    openModal() {
      this.isOpen = true;
    },
    closeModal() {
      this.isOpen = false;
    },
    openOrganizationModal() {
      this.isOrgOpen = true;
    },
    closeOrganizationModal() {
      this.isOrgOpen = false;
    },
  },
};
</script>
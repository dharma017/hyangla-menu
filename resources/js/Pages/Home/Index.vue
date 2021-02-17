<template>
  <div>
    <div
      class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400"
      v-if="isOrgOpen"
    >
      <div
        class="flex items-end justify-center pt-40 px-4 pb-20 text-center sm:block sm:p-0"
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
              class="absolute top-0 right-0 text-3xl text-gray-900 my-2 mx-4"
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
    <img
      class="object-contain w-full"
      v-if="organization.image"
      :src="organization.image"
    />
  </div>
</template>

<script>
export default {
  metaInfo: { title: "Hyangla Menu" },
  props: {
    organization: Object,
  },
  data() {
    return {
      isOrgOpen: false,
    };
  },
  created() {
    if (this.organization.enable_marketing) {
      this.openOrganizationModal();
    }
  },
  destroyed() {
    console.log("Component has been destroyed!");
  },
  methods: {
    openOrganizationModal() {
      this.isOrgOpen = true;
    },
    closeOrganizationModal() {
      this.isOrgOpen = false;
    },
  },
};
</script>
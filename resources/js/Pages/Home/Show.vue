<template>
  <div>
    <img class="object-contain w-full" v-if="menu.image" :src="menu.image" />
    <marketing-modal :showing="isOpen" @close="isOpen = false">
      <div class="modal-body">
        <img
          class="object-contain w-full"
          slot="body"
          v-if="menu.marketing_image"
          :src="menu.marketing_image"
        />
      </div>
    </marketing-modal>
    <marketing-modal :showing="isOrgOpen" @close="isOrgOpen = false">
      <div class="modal-body">
        <img
          class="object-contain w-full"
          slot="body"
          v-if="organization.marketing_image"
          :src="organization.marketing_image"
        />
      </div>
    </marketing-modal>
  </div>
</template>

<script>
import MarketingModal from "@/Shared/MarketingModal";
export default {
  metaInfo: { title: "Hyangla Menu" },
  components: {
    MarketingModal,
  },
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
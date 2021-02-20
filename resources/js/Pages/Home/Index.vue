<template>
  <div>
    <img
      class="object-contain w-full"
      v-if="organization.image"
      :src="organization.image"
    />
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
    organization: Object,
  },
  data() {
    return {
      isOrgOpen: false,
    };
  },
  created() {
    if (this.organization.enable_marketing) {
      this.isOrgOpen = true;
    }
  },
  destroyed() {
    console.log("Component has been destroyed!");
  },
  methods: {
    // openOrganizationModal() {
    //   this.isOrgOpen = true;
    // },
  },
};
</script>
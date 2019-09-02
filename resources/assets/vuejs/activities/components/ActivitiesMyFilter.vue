<script>
    export default {
        name: "ActivitiesMyFilter"
    }
</script>

<style scoped>

</style>

<template>
    <span>
    <label  class="col-form-label">Kun mine?&nbsp;</label>
    <span class="kt-switch kt-switch--sm kt-switch--icon" style="display: flex;align-self: flex-end;">

		<label>
			<input type="checkbox" v-model="filters[0]" @change="activitiesLoad('reload')">
			<span></span>
		</label>

	</span>
    </span>
</template>

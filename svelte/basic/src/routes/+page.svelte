<script>
	import PackageInfo from '../components/PackageInfo.svelte';

	const pkg = {
		name: 'svelte',
		version: 5,
		description: 'blazing fast',
		website: 'https://svelte.dev'
	};
</script>

<PackageInfo {...pkg} />

<!-- <PackageInfo
	version={pkg.version}
	description={pkg.description}
	website={pkg.website}
/> -->


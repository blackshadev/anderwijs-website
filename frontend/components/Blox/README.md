All blox components are included in the blox-item entry point.

The returned `type` in the block API should match the component name. Eg a block with type 'test' would have a vue component named `blox-test.global.vue`

The global part is required because the blox-item dynamically include the vue components and blox-row references blox-item again.

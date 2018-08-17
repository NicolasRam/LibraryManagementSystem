<template>
    <div id="app">
        <hello/>
    </div>
</template>

<script>
    import Hello from './components/Hello'

    class TestClassSyntax {
    }

    export default {
        name: 'app',
        components: {
            Hello
        }
    }
</script>
<template>
    <section class="tg-haslayout" style="margin-top: 120px">
        <div class="container">
            <div class="row">
                <div class="tg-allstatus">
                    <all-status-item-blue :booksCount="booksCount"/>
                    <all-status-item-purple :membersCount="membersCount"/>
                    <all-status-item-red :librariesCount="librariesCount"/>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import AllStatusItemBlue from '@/components/items/allstatus/AllStatusItemBlue'
    import AllStatusItemPurple from '@/components/items/allstatus/AllStatusItemPurple'
    import AllStatusItemRed from '@/components/items/allstatus/AllStatusItemRed'

    export default {
        name: 'AllStatus',

        components: {
            AllStatusItemBlue,
            AllStatusItemPurple,
            AllStatusItemRed,
        },

        props: {
            booksCount: {
                type: Number,
                default: 0
            },

            membersCount: {
                type: Number,
                default: 0
            },

            librariesCount: {
                type: Number,
                default: 0
            },
        }
    }
</script>

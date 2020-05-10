<template>
    <div class="contacts-list">
        <template>
            <v-subheader>Unread Messages</v-subheader>
            <v-list-item
                v-for="contact in sortedContacts"
                :key="contact.id"
                @click="selectContact(contact)"
                :class="{ selected: contact == selected }"
                id="single-user-list"
                v-if="contact.unread"
            >
                <v-list-item-avatar>
                    <v-img
                        :src="`/storage/profile/${contact.image}`"
                        :alt="contact.name"
                    >
                        <template v-slot:placeholder>
                            <v-row
                                class="fill-height ma-0"
                                align="center"
                                justify="center"
                            >
                                <v-img :src="placeholder"></v-img>
                            </v-row>
                        </template>
                    </v-img>
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>{{ contact.name }}</v-list-item-title>
                </v-list-item-content>

                <v-list-item-icon v-if="contact.unread">
                    <v-btn fab x-small dark color="green">
                        <span>{{ contact.unread }}</span>
                    </v-btn>
                </v-list-item-icon>
            </v-list-item>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        contacts: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            placeholder: "/images/logoBox.png",
            selected: this.contacts.length ? this.contacts[0] : null
        };
    },
    methods: {
        selectContact(contact) {
            this.selected = contact;
            this.$emit("selected", contact);
        }
    },
    computed: {
        sortedContacts() {
            return _.sortBy(this.contacts, [
                contact => {
                    if (contact == this.selected) {
                        return Infinity;
                    }
                    return contact.unread;
                }
            ]).reverse();
        }
    }
};
</script>

<style lang="scss" scoped>
#single-user-list {
    border-bottom: 1px solid #efefef;
}
.contacts-list {
    min-height: 72vh;
    overflow: scroll;
    border-left: 1px solid #efefef;
    background: #fff;
    ul {
        list-style-type: none;
        padding-left: 0;
        li {
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #aaaaaa;
            height: 80px;
            position: relative;
            cursor: pointer;

            &.selected {
                background: #dfdfdf;
            }
            span.status {
                background: #82e0a8;
                color: #fff;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }

            .avatar {
                flex: 1;
                display: flex;
                align-items: center;

                img {
                    width: 35px;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            }
            .contact {
                flex: 3;
                font-size: 10px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;

                p {
                    margin: 0;
                    &.name {
                        font-weight: bold;
                    }
                }
            }
        }
    }
}
</style>

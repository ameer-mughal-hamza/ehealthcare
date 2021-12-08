<template>
    <div class="col-lg-12">
        <div class="social-feed-box">
            <div class="social-avatar">
                <a href="" class="float-left">
                    <img alt="image" src="http://localhost:8000/img/a1.jpg"/>
                </a>
                <div class="media-body">
                    <!--                    <a href="#">{{ post.user.name }}</a>-->
                    <small class="text-muted">{{ post.time }} - {{ post.date_created }}</small>
                </div>
            </div>
            <div class="social-body">
                <p>
                    {{ post.description }}
                </p>

                <div class="btn-group">
                    <button class="btn btn-white btn-xs">
                        <i class="fa fa-thumbs-up"></i> Like this!
                    </button>
                    <button class="btn btn-white btn-xs">
                        <i class="fa fa-comments"></i> Comment
                    </button>
                </div>
            </div>
            <div class="social-footer">
                <div class="social-comment" v-for="comment in post.comments">
                    <a href="" class="float-left">
                        <img alt="image" src="http://localhost:8000/img/a1.jpg"/>
                    </a>
                    <div class="media-body">
                        <!--                        <a href="#">{{ comment.name }}</a>-->
                        {{ comment.description }}
                        <br/>
                        <a href="#" class="small"
                        ><i class="fa fa-thumbs-up"></i> 26 Like this!</a
                        >
                        -
                        <small class="text-muted">{{ comment.time }} - {{ comment.date_created }}</small>
                    </div>
                </div>
                <div class="social-comment">
                    <a href="" class="float-left">
                        <img alt="image" src="http://localhost:8000/img/a1.jpg"/>
                    </a>
                    <div class="media-body">
                      <textarea
                          id="comment" name="comment"
                          v-model="comment"
                          class="form-control"
                          placeholder="Write comment..."
                      ></textarea>
                        <div v-if="errors && errors.description" class="text-danger">{{ errors.description[0] }}</div>
                    </div>
                    <div class="text-right">
                        <button class="mt-2 btn btn-primary btn-xs" v-on:click="postComment(post.id)">Post!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            post: {},
            comment: "",
            errors: {},
            id: ""
        }
    },
    methods: {
        fetchPosts() {
            axios.get('/api/blogs/1').then(response => {
                this.post = JSON.parse(response.data.slice(2));
            });
        },
        postComment(post_id) {
            this.errors = {};
            axios.post('/api/blogs', {
                post_id: post_id,
                comment: this.comment
            }).then(response => {
                this.comment = "";
                this.post.comments.push(JSON.parse(response.data.slice(2)))
            }).catch(error => {
                const trimString = error.response.data.slice(2);
                if (error.response.status === 422) {
                    this.errors = JSON.parse(trimString).errors || {};
                }
            });
        },
    },
    mounted() {
        this.fetchPosts();
        Echo.channel('post').listen('PostEvent', (e) => {
            console.log(e.message);
        });

        // Echo.private('post').listen('PostEvent', (e) => {
        //     console.log(e.message);
        // });
    }
}
</script>

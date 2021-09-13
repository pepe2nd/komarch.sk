<template>
    <svg viewBox="0 0 40 40" class="mx-auto md:ml-0 h-full w-auto" ref="svg" >
      <circle cx="20" cy="20" r="19" />
      <line x1="-1" y1="0" x2="11" y2="0" class="hour" />
      <line x1="-1" y1="0" x2="15" y2="0" class="minute" />
      <line x1="-1" y1="0" x2="18" y2="0" class="seconds" />
    </svg>
</template>

<script>

export default {
  data () {
    return {
      currentTime: null
    }
  },
  mounted() {
    const timer = window.setTimeout(this.updateTime, 1000);
  },
  computed: {
    updateTime() {
      this.currentTime = new Date();
      this.$refs.svg.style.setProperty('--start-seconds', this.currentTime.getSeconds());
      this.$refs.svg.style.setProperty('--start-minutes', this.currentTime.getMinutes());
      this.$refs.svg.style.setProperty('--start-hours', this.currentTime.getHours() % 12);
    }
  }
}

</script>

<style scoped>
  svg {
    width:  auto;
    fill: none;
    stroke: #000;
    stroke-width: 0.2;
    transform: rotate(-90deg);
    --start-seconds: 57;
    --start-minutes: 45;
    --start-hours: 11;
  }

  .seconds,
  .minute,
  .hour
  {
    transform: translate(20px, 20px) rotate(0deg);
  }

  .seconds {
    transform: translate(20px, 20px) rotate(calc(var(--start-seconds) * 6deg));
    animation: rotateSecondHand 60s steps(60) infinite;
  }

  .minute {
    transform: translate(20px, 20px) rotate(calc(var(--start-minutes) * 6deg));
    animation: rotateMinuteHand 3600s steps(60) infinite;
    animation-delay: calc(var(--start-seconds) * -1 * 1s);
  }

  .hour {
    transform: translate(20px, 20px) rotate(calc(var(--start-hours) * 30deg));
    animation: rotateHourHand calc(12 * 60 * 60s) linear infinite;
    animation-delay: calc(calc(var(--start-minutes) * -60 * 1s) + calc(var(--start-seconds) * -1 * 1s));
  }

  @keyframes rotateSecondHand {
    from {
      transform: translate(20px, 20px) rotate(calc(var(--start-seconds) * 6deg));
    }
    to {
      transform: translate(20px, 20px) rotate(calc(var(--start-seconds) * 6deg + 360deg));
    }
  }

  @keyframes rotateMinuteHand {
    from {
      transform: translate(20px, 20px) rotate(calc(var(--start-minutes) * 6deg));
    }
    to {
      transform: translate(20px, 20px) rotate(calc(var(--start-minutes) * 6deg + 360deg));
    }
  }

  @keyframes rotateHourHand {
    from {
      transform: translate(20px, 20px) rotate(calc(var(--start-hours) * 30deg));
    }
    to {
      transform: translate(20px, 20px) rotate(calc(var(--start-hours) * 30deg + 360deg));
    }
  }

</style>
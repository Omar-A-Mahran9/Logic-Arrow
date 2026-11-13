<script setup>
import NavBar from './components/NavBar.vue'
import HeroSection from './components/HeroSection.vue'
import CapabilityBand from './components/CapabilityBand.vue'
import SolutionsSection from './components/SolutionsSection.vue'
import BuiltInEgypt from './components/BuiltInEgypt.vue'
import AiSection from './components/AiSection.vue'
import ClubJourney from './components/ClubJourney.vue'
import HowWeWork from './components/HowWeWork.vue'
import TeamSection from './components/TeamSection.vue'
import ClientVoices from './components/ClientVoices.vue'
import NextSteps from './components/NextSteps.vue'
import ContactForm from './components/ContactForm.vue'
import SiteFooter from './components/SiteFooter.vue'
</script>

<template>
  <NavBar />
  <main>
    <HeroSection />
    <CapabilityBand />
    <SolutionsSection />
    <BuiltInEgypt />
    <AiSection />
    <ClubJourney />
    <HowWeWork />
    <TeamSection />
    <ClientVoices />
    <NextSteps />
    <ContactForm />
  </main>
  <SiteFooter />
</template>

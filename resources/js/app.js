import './bootstrap';
import "flowbite";
import { initFlowbite } from 'flowbite';

Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
    succeed(({ snapshot, effect }) => {
        setTimeout(() => {
            initFlowbite();
        }, 100); // Adjust the delay as needed
    })
})

document.addEventListener('livewire:navigated', () => {
    initFlowbite();
});

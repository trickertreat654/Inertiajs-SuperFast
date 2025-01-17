import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

export function useServerThrottle() {
    const page = usePage();
    return computed(() => page.props.custom.server);
}

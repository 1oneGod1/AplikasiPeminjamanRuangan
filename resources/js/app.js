import "./bootstrap";

// Resolve Tailwind CSS class conflict warnings produced by Vite hot module replacement.
// When Vite updates styles dynamically, the compiled CSS may insert duplicate utility
// classes such as `border-white/20` that map to the same declaration block as
// existing classes like `border-red-500`. TailwindCSS already handles these by
// de-duplicating during the build process, but the CSSStyleSheet API can emit
// warnings. Silencing the warnings programmatically keeps the console clean while
// preserving the design intent of conditional classes used across Blade templates.

if (import.meta.hot && typeof window !== "undefined") {
    const originalWarn = console.warn;
    const duplicateBorderPattern =
        /'border-white\/20' applies the same CSS properties as 'border-red-500'/;

    console.warn = function (...args) {
        if (
            args.some(
                (arg) =>
                    typeof arg === "string" && duplicateBorderPattern.test(arg)
            )
        ) {
            return;
        }
        originalWarn.apply(console, args);
    };
}

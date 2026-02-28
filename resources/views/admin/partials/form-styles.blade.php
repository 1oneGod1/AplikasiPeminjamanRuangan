@php
  $adminFormCardClass = $adminFormCardClass ?? 'rounded-[28px] border border-white/10 bg-slate-900/80 p-8 sm:p-10 text-slate-100 shadow-2xl shadow-black/25';
  $adminFormHeaderClass = $adminFormHeaderClass ?? 'text-2xl font-semibold text-white';
  $adminFormSubtextClass = $adminFormSubtextClass ?? 'text-sm text-slate-400';
  $adminLabelClass = $adminLabelClass ?? 'block text-xs font-semibold uppercase tracking-[0.22em] text-slate-400';
  $adminHelperTextClass = $adminHelperTextClass ?? 'text-xs text-slate-500';
  $adminInputClass = $adminInputClass ?? 'w-full rounded-2xl border border-slate-700/70 bg-slate-800/60 px-4 py-3 text-sm text-slate-100 placeholder-slate-500 shadow-inner shadow-black/20 transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/40';
  $adminTextareaClass = $adminTextareaClass ?? $adminInputClass . ' min-h-[140px]';
  $adminSelectClass = $adminSelectClass ?? $adminInputClass . ' pr-10';
  $adminCheckboxClass = $adminCheckboxClass ?? 'h-5 w-5 rounded border-slate-600 bg-slate-800 text-yellow-400 focus:ring-yellow-400/40';
  $adminPrimaryButtonClass = $adminPrimaryButtonClass ?? 'inline-flex items-center justify-center rounded-xl bg-yellow-400 px-6 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-yellow-500/30 transition hover:bg-yellow-300 focus:outline-none focus:ring-4 focus:ring-yellow-400/40';
  $adminSecondaryButtonClass = $adminSecondaryButtonClass ?? 'inline-flex items-center justify-center rounded-xl border border-slate-600 px-6 py-3 text-sm font-semibold text-slate-200 transition hover:bg-slate-800/60';
  $adminFormSectionDivider = $adminFormSectionDivider ?? 'border-t border-slate-800/70';
@endphp

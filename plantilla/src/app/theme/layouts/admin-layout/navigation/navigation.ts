export interface NavigationItem {
  id: string;
  title: string;
  type: 'item' | 'collapse' | 'group';
  translate?: string;
  icon?: string;
  hidden?: boolean;
  url?: string;
  classes?: string;
  groupClasses?: string;
  exactMatch?: boolean;
  external?: boolean;
  target?: boolean;
  breadcrumbs?: boolean;
  children?: NavigationItem[];
  link?: string;
  description?: string;
  path?: string;
}

export const NavigationItems: NavigationItem[] = [
  {
    id: 'dashboard',
    title: 'Dashboard',
    type: 'group',
    icon: 'icon-navigation',
    children: [
      
    ]
  },
  {
    id: 'authentication',
    title: 'Authentication',
    type: 'group',
    icon: 'icon-navigation',
    children: [
      
      
    ]
  },
  {
    id: 'utilities',
    title: 'MENU',
    type: 'group',
    icon: 'icon-navigation',
    children: [
      {
        id: 'Pacientes',
        title: 'Pacientes',
        type: 'item',
        classes: 'nav-item',
        url: '/pacientes',
        icon: 'ant-design'
      },
      {
        id: 'citas',
        title: 'reporte citas',
        type: 'item',
        classes: 'nav-item',
        url: '/citas',
        icon: 'ant-design'
      },
      {
        id: 'Doctores',
        title: 'Doctores',
        type: 'item',
        classes: 'nav-item',
        url: '/doctores',
        icon: 'ant-design'
      },
      
      
      
    ]
  },

  {
    id: 'other',
    title: 'Other',
    type: 'group',
    icon: 'icon-navigation',
    children: [
      {
        id: 'sample-page',
        title: 'Sample Page',
        type: 'item',
        url: '/sample-page',
        classes: 'nav-item',
        icon: 'chrome'
      },
      {
        id: 'document',
        title: 'Document',
        type: 'item',
        classes: 'nav-item',
        url: 'https://codedthemes.gitbook.io/mantis-angular/',
        icon: 'question',
        target: true,
        external: true
      }
    ]
  }
];

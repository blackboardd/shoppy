import { ComponentMeta, ComponentStory } from '@storybook/react';
import Navbar from 'features/navbar/components';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';

export default {
  title: 'Shoppy/Navbar',
  component: Navbar,
} as ComponentMeta<typeof Navbar>;

const Template: ComponentStory<typeof Navbar> = () => {
  return (
    <Navbar>
      <h1>Navbar</h1>
    </Navbar>
  );
};

export const Primary = Template.bind({});

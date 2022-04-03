import { PlusCircleFill } from 'react-bootstrap-icons';

/**
 * Add button component.
 *
 * @returns {JSX.Element}
 */
const AddButton = (): JSX.Element => {
  // Function to handle clicks on the button that route the page to the add product page
  const handleClick = (): void => {
    window.location.href = '/add';
  };

  return (
    <div className="btn-add">
      <button
        className="btn-float btn-icon btn btn-primary btn-lg"
        onClick={handleClick}
      >
        <p style={{ marginBottom: 0 }}>Add</p>
        <div className="floating-btn-icon">
          {' '}
          <PlusCircleFill />
        </div>
      </button>
    </div>
  );
};

export default AddButton;
